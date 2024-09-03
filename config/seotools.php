<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "إتحاد الجامعات السودانية - Association Sudanese Universities", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'تأسس اتحاد الجامعات السودانية في نوفمبر 1995م و في فبراير 2009 تم تسجيله لدى المسجل العام للمنظمات كأحد منظمات العمل الطوعي وذلك وفقاً لأحكام قانون تنظيم العمل الطوعي والإنساني لعام 2006م. ليضم مؤسسات التعليم العالي الحكومية والأهلية بهدف تحقيق اهداف التعليم العالي في إعداد وتنمية القدرات البشرية وترقية البحث العلمي وخدمة المجتمع.
            يعمل الاتحاد وفقاً لنظامه الأساس المجاز من قبل المجلس ووفقاً لنظمه ولوائحه الداخلية التي تنظم اعماله وأنشطته المختلفة. وللاتحاد شخصية اعتبارية مستقلة وخاتم عام. كانت عضوية الاتحاد عند التأسيس أقل من عشرين جامعة ، في حين بلغت عضويته في 2022 اكثر من مائة وعشر مؤسسة تعليم عالي ( جامعة, كلية , اكاديمية, مركز بحثي).', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ["اتحاد_الجامعات_السودانية","الجامعات_السودانية","التعليم_العالي","السودان",
                                "Sudan","Association_Sudanese_Universities","education","ASU","asuorgsd"],
            'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => false, // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => false, // set false to total remove
            'url'         => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
