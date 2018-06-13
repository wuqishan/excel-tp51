<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function get_file_ext($filename)
{
    return strtolower(substr($filename, strrpos($filename, '.') + 1));
}

/**
 * 获取上传文件名
 *
 * @return string
 */
function get_upload_filename()
{
    return session_id() . '_img';
}

/**
 * 获取缓存key
 *
 * @param $k
 * @return string
 */
function key_c($k)
{
    return md5(session_id() . $k);
}

/**
 * 获取excel头信息
 *
 * @return array
 */
function get_excel_data()
{
    return [
        'A' => [
            'title' => '序号',
            'update' => false,
            'values' => []
        ],
//        'B' => [
//            'title' => '编号',
//            'update' => false,
//            'values' => ''
//        ],
        'C' => [
            'title' => '检测日期',
            'values' => ''
        ],
//        'D' => [
//            'title' => '所属医院',
//            'values' => ''
//        ],
//        'E' => [
//            'title' => '医生',
//            'values' => ''
//        ],
        'F' => [
            'title' => '姓名',
            'values' => ''
        ],
        'H' => [
            'title' => '性别',
            'values' => [
                '男',
                '女'
            ]
        ],
        'I' => [
            'title' => '年龄',
            'values' => ''
        ],
        'J' => [
            'title' => '手机',
            'values' => ''
        ],
        'L' => [
            'title' => '就诊地点',
            'values' => [
                '门诊',
                '病房'
            ]
        ],
        'N' => [
            'title' => '患者类型',
            'values' => [
                '高血压',
                '糖尿病',
                '既往卒中史',
                '既往冠心病'
            ]
        ],
        'O' => [
            'title' => '血压收缩压',
            'values' => ''
        ],
        'P' => [
            'title' => '血压舒张压',
            'values' => ''
        ],
        'Q' => [
            'title' => '高血压病程(年)',
            'values' => ''
        ],
        'R' => [
            'title' => '身高cm',
            'values' => ''
        ],
        'S' => [
            'title' => '体重kg',
            'values' => ''
        ],
        'V' => [
            'title' => '降压方案 > 方案',
            'values' => [
                '利尿剂',
                '血管紧张素转换酶抑制剂',
                'β受体阻滞剂',
                '钙通道阻滞剂',
                '其他'
            ]
        ],
        'W' => [
            'title' => '降压方案 > 其他备注',
            'values' => ''
        ],
        'Y' => [
            'title' => '降压方案 > 血管紧张素II受体阻滞剂',
            'values' => [
                '常规剂量',
                '双倍剂量'
            ]
        ],
        'AA' => [
            'title' => '降压方案 > 单片复方制剂',
            'values' => [
                'ARB+利尿剂',
                'ARB+CCB'
            ]
        ],
        'AB' => [
            'title' => '既往卒中史 > 评分',
            'values' => ''
        ],
        'AF' => [
            'title' => '既往卒中史/冠心病史 > 抗血小板方案',
            'values' => [
                '阿斯匹林',
                '氯吡格雷',
                '阿斯匹林+氯吡格雷',
                '其他'
            ]
        ],
        'AH' => [
            'title' => '颈动脉超声 > 正常/硬化斑块',
            'values' => [
                '正常',
                '硬化斑块'
            ]
        ],
        'AJ' => [
            'title' => '颈动脉超声 > 内中膜厚度（IMT）',
            'values' => [
                'IMT≤0.9mm',
                'IMT ≥1.0mm'
            ]
        ],
        'AL' => [
            'title' => '颈动脉超声 > 硬化',
            'values' => [
                '低回声',
                '高回声'
            ]
        ],
        'AN' => [
            'title' => '颈动脉超声 > 斑块',
            'values' => [
                '50%<狭窄<75%',
                '狭窄≥75%'
            ]
        ],
        'AP' => [
            'title' => '检测结果 > 尿蛋白',
            'values' => [
                '阴性',
                '阳性'
            ]
        ],
        'AQ' => [
            'title' => '检测结果 > 尿白蛋白（mg/dL）',
            'values' => [
                '1',
                '3',
                '8',
                '15'
            ]
        ],
        'AR' => [
            'title' => '检测结果 > 尿肌酐（mg/dL）',
            'values' => [
                '10',
                '50',
                '100',
                '200',
                '300'
            ]
        ],

        '_M' => [], '_X' => [], '_K' => [], '_G' => [], '_T' => [], '_U' => [], '_Z' => [],
        '_AK' => [], '_AM' => [], '_AG' => [], '_AI' => [], '_AD' => [],
        '_AO' => [], '_AC' => [], '_AS' => [], '_AT' => [], '_AE' => [],
    ];
}
