<?php
namespace App\Traits;


trait DateTraits {
    protected $years = [
        2019,2020,2021,2022
    ];

    protected $months = [
        [
        	'name' => 'January',
        	'value' => 1,
        ],
        [
        	'name' => 'February',
        	'value' => 2,
        ],
        [
        	'name' => 'March',
        	'value' => 3,
        ],
        [
        	'name' => 'April',
        	'value' => 4,
        ],
        [
        	'name' => 'May',
        	'value' => 5,
        ],
        [
        	'name' => 'June',
        	'value' => 6,
        ],
        [
        	'name' => 'July',
        	'value' => 7,
        ],
        [
        	'name' => 'August',
        	'value' => 8,
        ],
        [
        	'name' => 'September',
        	'value' => 9,
        ],
        [
        	'name' => 'October',
        	'value' => 10,
        ],
        [
        	'name' => 'November',
        	'value' => 11,
        ],
        [
        	'name' => 'December',
        	'value' => 12,
        ],
    ];

    public function getYearMonth()
    {
        $data = [
            'year' => $this->years,
            'month' => $this->months,
        ];

        return $data;
    }

    public function getYear()
    {
        return $this->years;
    }
    public function getMonth()
    {
        return $this->months;
    }
}