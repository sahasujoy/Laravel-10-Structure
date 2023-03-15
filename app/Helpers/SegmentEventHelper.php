<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Log;

class SegmentEventHelper
{
    // ===== ACTION LIST ========
    const FIRST_SESSION = 1;
    const LAST_SESSION = 2;
    const SESSION_COUNT = 3;
    const COUNTRY = 4;

    // ======CONDITION LIST 1 ==========
    const IS = 1;
    const START_WITH = 2;
    const ENDS_WITH = 3;
    const CONTAINS = 4;
    const DOES_NOT_CONTAINS = 5;
    const IS_NOT = 6;
    const IS_KNOW = 7;
    const IS_NOT_KNOWN = 8;
    const IS_IN_LIST = 9;
    const IS_NOT_IN_LIST = 10;
    const IS_EQUAL = 11;
    const IS_NOT_EQUAL = 12;
    const IS_GREATER = 13;
    const IS_GREATER_THAN_OR_EQUAL_TO = 14;
    const IS_LESS_THAN = 15;
    const IS_LESS_THAN_OR_EQUAL_TO = 16;
    const IS_BEFORE = 17;
    const IS_AFTER = 18;
    const IS_WITHIN = 19;
    const IS_NOT_WITHIN = 20;

    const CONDITION_ALL = 1;
    const CONDITION_ANY = 2;

    public static $getAllTriggerEventAction = [
        self::FIRST_SESSION => 'First Session',
        self::LAST_SESSION => 'Last Session',
        self::SESSION_COUNT => 'Session Count',
        self::COUNTRY => 'Country',
    ];

    public static function getAllConditionDataType()
    {
        return [
            self::IS => '=',
            self::START_WITH => '%',
            self::ENDS_WITH => '%',
            self::CONTAINS => 'LIKE',
            self::DOES_NOT_CONTAINS => 'NOT LIKE',
            self::IS_NOT => '!=',
            self::IS_IN_LIST => 'in',
            self::IS_NOT_IN_LIST => 'not in',
            self::IS_EQUAL => '=',
            self::IS_NOT_EQUAL => '!=',
            self::IS_GREATER => '>',
            self::IS_GREATER_THAN_OR_EQUAL_TO => '>=',
            self::IS_LESS_THAN => '<',
            self::IS_LESS_THAN_OR_EQUAL_TO => '<=',
            self::IS_BEFORE => '<',
            self::IS_AFTER => '>',
            self::IS_WITHIN => '<',
            self::IS_NOT_WITHIN => '>',
        ];
    }

    public static function getConditionValue($conditionDataType)
    {
        $value = match($conditionDataType) {
            self::IS => '=',
            self::CONTAINS => 'LIKE',
            self::DOES_NOT_CONTAINS => 'NOT LIKE',
            self::IS_NOT => '!=',
            self::IS_IN_LIST => 'in',
            self::IS_NOT_IN_LIST => 'not in',
            self::IS_GREATER => '>',
            self::IS_GREATER_THAN_OR_EQUAL_TO => '>=',
            self::IS_LESS_THAN => '<',
            self::IS_LESS_THAN_OR_EQUAL_TO => '<=',
        };

        return $value;
    }

    /**
     * concert event action name to readable name
     * @param $actionName
     * @return string
     */
    public static function getEventActionName($actionName)
    {
        return match ($actionName) {
            "first_session" => 'First Session',
            "last_session" => 'Last Session',
            "session_count" => 'Session Count',
            "country" => 'Country',
        };
    }

    /**
     * @param $actionName
     * @return int|string
     */
    public static function getEventActionConstValueFieldNameWise($actionName)
    {
        return match ($actionName) {
            "first_session" => self::FIRST_SESSION,
            "last_session" => self::LAST_SESSION,
            "session_count" => self::SESSION_COUNT,
            "country" => self::COUNTRY,
        };
    }

    public static function getRelationName($actionName)
    {
        return match ($actionName) {
            "=" => 'is',
            ">" => 'greater than',
            "<" => 'less than',
            "!=" => 'is not',
        };
    }

    public static function getSegmentRelationName($conditionDataType)
    {
        $value = match($conditionDataType) {
            self::FIRST_SESSION => 'first_session_relation',
            self::LAST_SESSION => 'last_session_relation',
            self::SESSION_COUNT => 'session_relation',
            self::COUNTRY => 'country_relation'
        };

        return $value;
    }

    public static function getEventConditionRules()
    {
        return [
            self::FIRST_SESSION => [
                'index' => self::FIRST_SESSION,
                'name' => 'First Session',
                'event_action_condition' => [
                    self::IS_GREATER => [
                        'name' => 'greater than',
                        'value' => self::getConditionValue(self::IS_GREATER)
                    ],
                    self::IS_LESS_THAN => [
                        'name' => 'less than',
                        'value' => self::getConditionValue(self::IS_LESS_THAN)
                    ]
                ],
            ],
            self::LAST_SESSION => [
                'index' => self::LAST_SESSION,
                'name' => 'Last Session',
                'event_action_condition' => [
                    self::IS_GREATER => [
                        'name' => 'greater than',
                        'value' => self::getConditionValue(self::IS_GREATER)
                    ],
                    self::IS_LESS_THAN => [
                        'name' => 'less than',
                        'value' => self::getConditionValue(self::IS_LESS_THAN)
                    ]
                ],
            ],
            self::SESSION_COUNT => [
                'index' => self::SESSION_COUNT,
                'name' => 'Session Count',
                'event_action_condition' => [
                    self::IS => [
                        'name' => 'is',
                        'value' => self::getConditionValue(self::IS)
                    ],
                    self::IS_GREATER => [
                        'name' => 'greater than',
                        'value' => self::getConditionValue(self::IS_GREATER)
                    ],
                    self::IS_LESS_THAN => [
                        'name' => 'less than',
                        'value' => self::getConditionValue(self::IS_LESS_THAN)
                    ]
                ],
            ],
            self::COUNTRY => [
                'index' => self::COUNTRY,
                'name' => 'Country',
                'event_action_condition' => [
                    self::IS => [
                        'name' => 'is',
                        'value' => self::getConditionValue(self::IS)
                    ],
                    self::IS_NOT => [
                        'name' => 'is not',
                        'value' => self::getConditionValue(self::IS_NOT)
                    ],
                ],
            ],
        ];
    }
}
