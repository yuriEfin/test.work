<?php

use yii\db\Migration;

/**
 * Class m180308_123158_create_structure_database
 */
class m180308_123158_create_structure_database extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->down();
        $data = [
            'employee' => [
                'columns' => [
                    'id' => $this->primaryKey(),
                    'lastname' => $this->string(300) . ' NOT NULL COMMENT "Фамилия"',
                    'username' => $this->string(300) . ' NOT NULL COMMENT "Имя"',
                    'middlename' => $this->string(300) . ' NOT NULL COMMENT "Отчество"',
                ],
            ],
            'salary' => [
                'columns' => [
                    'id' => $this->primaryKey(),
                    'user_id' => $this->integer() . ' NOT NULL COMMENT "Работник"',
                    'summ' => $this->integer() . ' NOT NULL COMMENT "Сумма оклада"'
                ],
            ],
            'call_stat' => [
                'columns' => [
                    'id' => $this->primaryKey(),
                    'user_id' => $this->integer() . ' NOT NULL COMMENT "Работник"',
                    'date' => $this->date() . ' NOT NULL COMMENT "Дата"',
                    'count' => $this->integer() . ' COMMENT "Кол-во звонков"'
                ],
            ],
            'bonus' => [
                'columns' => [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(100) . ' NOT NULL COMMENT "Категория"',
                    'operator' => $this->string(50) . ' NOT NULL COMMENT "Больше, меньше"',
                    'count' => $this->integer() . ' NOT NULL COMMENT "Шаг начисления"',
                    'summ_bonus' => $this->float([0, 10]) . ' NOT NULL COMMENT "Сумма бонуса"',
                    'period' => $this->integer() . ' NOT NULL DEFAULT 22 COMMENT "Период расчета бонуса"',
                    'unit_period' => $this->string() . ' NOT NULL DEFAULT "day" COMMENT "Единица измерения"',
                ]
            ]
        ];

        foreach ($data as $table => $columns) {
            if (!$this->getDb()->getSchema()->getTableSchema($table, true)) {
                $this->createTable($table, $columns['columns']);
                $this->createIndexByTable($table);
            }
        }

        $this->loadData();
    }

    private function loadData()
    {
        $datas = [
            'employee' => [
                [
                    'lastname' => 'Браун',
                    'username' => 'Хельга',
                    'middlename' => '',
                ],
                [
                    'lastname' => 'Барак',
                    'username' => 'Обама',
                    'middlename' => '',
                ],
                [
                    'lastname' => 'Козлов',
                    'username' => 'Денис',
                    'middlename' => '',
                ]
            ],
            'salary' => [
                [
                    'user_id' => 1,
                    'summ' => 20000
                ],
                [
                    'user_id' => 2,
                    'summ' => 30000
                ],
                [
                    'user_id' => 3,
                    'summ' => 40000
                ]
            ],
            'bonus' => [
                [
                    'title' => 'Начальная',
                    'count' => 100,
                    'operator' => '<=',
                    'summ_bonus' => 100,
                    'period' => 22,
                    'unit_period' => 'day'
                ],
                [
                    'title' => 'Средняя',
                    'count' => 200,
                    'operator' => '<=',
                    'summ_bonus' => 200,
                    'period' => 22,
                    'unit_period' => 'day'
                ],
                [
                    'title' => 'Высшая',
                    'count' => 300,
                    'operator' => '>=',
                    'summ_bonus' => 300,
                    'period' => 22,
                    'unit_period' => 'day'
                ],
            ],
            'call_stat' => [
                $this->getDataCallStat(1),
                $this->getDataCallStat(2),
                $this->getDataCallStat(3),
            ],
        ];

        foreach ($datas as $table => $data) {
            foreach ($data as $item) {
                if ($table == 'call_stat') {
                    $this->loadDataCallStat($data);
                } else {
                    $this->insert($table, $item);
                }
            }
        }
    }

    /**
     * @param $datas
     * @throws \yii\db\Exception
     */
    private function loadDataCallStat($datas)
    {
        foreach ($datas as $item) {
            $i = 0;
            for ($i; $i <= count($item); $i++) {
                if (!isset($item[$i])) {
                    continue;
                }
                $isData = $this->db->createCommand('SELECT id FROM call_stat WHERE user_id=:user_id AND `date`=:date')
                    ->bindValue(':user_id', $item[$i]['user_id'])
                    ->bindValue(':date', $item[$i]['date'])->queryOne();

                if (!$isData) {
                    $this->insert('call_stat', $item[$i]);
                }
            }
        }
    }

    /**
     * @param $userId
     * @return array
     * @throws Exception
     */
    private function getDataCallStat($userId)
    {
        $items = [];

        $start = '1.01.2015';
        $i = 0;
        $j = 0;
        $counts = [
            1 => [10, 40, 40, 30, 10, null, null, 10, 20, 30, 10, 20, null, null],
            2 => [10, 20, 10, 0, 10, null, null, 10, null, null, null, null, null, null],
            3 => [10, 10, 10, 30, 10, null, null, 10, 10, 30, 10, 20, null, null],
        ];
        for ($i; $i <= 13; $i++) {
            $items[$i] = [
                'user_id' => $userId,
                'date' => (new DateTime($start))
                    ->add(new DateInterval('P' . $i . 'D'))
                    ->format('Y-m-d'),
                'count' => $counts[$userId][$j++],
            ];
        }
        return $items;
    }

    /**
     * @param $table
     */
    private function createIndexByTable($table)
    {
        $indexes = [
            'salary' => [
                [
                    'name' => 'xuser',
                    'column' => 'user_id',
                    'uniq' => true
                ]
            ],
            'call_stat' => [
                [
                    'name' => 'xuniqUserDate',
                    'column' => ['date', 'user_id'],
                    'uniq' => true
                ]
            ],
        ];

        if (isset($indexes[$table])) {
            foreach ($indexes[$table] as $index) {
                $this->createIndex($index['name'], $table, $index['column'], $index['uniq']);
            }
        }
    }

    /**
     * @return bool|void
     * @throws \yii\base\NotSupportedException
     */
    public function down()
    {
        $ts = [
            'employee',
            'salary',
            'call_stat',
            'bonus',
        ];

        foreach ($ts as $table) {
            if ($this->getDb()->getSchema()->getTableSchema($table, true)) {
                $this->dropTable($table);
            }
        }
    }
}
