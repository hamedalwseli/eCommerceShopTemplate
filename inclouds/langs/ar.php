<?php
 function lang($phr){

static $langs =array(
    'SORRY_YOU_CANT_BROWSE_THIS_PAGE_DIERECTLY'    =>'sorry you cant browse this page directly',
    'THERE_IS_AN_ERROR'    =>'there is An error',
    // strat index or login page
    'ADMIN_LOGIN'        =>'تسجيل دخول المسؤل',
    'USER_NAME'          =>'اسم المستخدك',
    'PASSWORD'           =>'كلمة المرور',
    'FORGET_THE_PASSOWRD'=>'هل نسيت كلمه المرور',
    ''=>'',
    // end index or login page
    // start navbar    
    'ADMIN_HOME'  =>'المسؤل',
    '_HOME'       =>'الرئيسة',
    'CATEGORIES'  =>'الاقسام',
    'LOGOUT'      =>'تسجيل الخروج',
    'EDIT_PROFILE'=>'تعديل الحساب',
    'SETTINGS'    =>'الاعدادات',
    'ITEMS'       =>'اغراض',
    'MEMBERS'     =>'اعضاء',
    'STATISTIC'   =>'الاحصائات',
    'COMMENTS'    =>'التعليقات',
    'LOGS'        =>'السجل',
    // end navbar 
    
    // start dashboard page
    'DASHBOARD'        =>'لوحة التحكم',
    'TOTAL_MEMBERS'    =>'مجموع الاعضاء',
    'PENDING_MEMBERS'  =>'الاعضاء المعلقون',
    'TOTAL_ITEMS'      =>'مجموع الاغراض',
    'TOTAL_COMMENTS'   =>'مجموع التعليقات',
    'LASTES_USERS'     =>'اخر المستخدمين',
    'LASTES_ITEMS'     =>'اخر الاغراض',
    // end dashboard page

    // start members page 
    // START MANAGE PAGE 
    'MANAGE_MEMBERS'        =>'ادارة الاعضاء ',
    '#ID'                   =>'#ID',
    'EMAIL'                 =>'البريد الالكتروني',
    'FULL_NAME'             =>'الاسم الكامل',
    'REGISTER_DATE'         =>'تاريخ التسجيل',
    'CONTROL'               =>'التحكم',
    'EDIT'                  =>'تعديل',
    'DELETE'                =>'حذف',
    'ACTIVATE'                =>'تنشيط',
    
    // END MANAGE PAGE 
    // START insert member page 
    'USER_EXSIST'           =>'المعذرة, هذا المستخدم موجود بالفعل',
    
    // end insert member page 
    // start edit member page 
    'EDIT_MEMBERS'       =>'تعديل العضو',
    'EDIT_MEMBER'        =>'تعديل الحساب',
    'MEMBER_USER_NAME'   =>' اسم المسخدم',
    'MEMBER_PASS'        =>'كلمة المرور الجديدة',
    'MEMBER_confirm_PASS'=>'تاكيد كلمة المرور',
    'USERNAME_EMPTY'     =>'يجب عليك ملئ حقل الاسم',
    'NOT_MATCH_PASS'     =>'كلمة سر غير متطابقة',
    'EMAIL_MEMBER'       =>'البريد',
    'EMAIL_EMPTY'        =>'عليك ادخال البريد ',
    'MEMBER_FILL_NAME'   =>' الاسم الكامل',
    'FULLNAME_EMPTY'     =>'عليك ادخال الاسم الكامل ',

    // end edit member page 

    // start update page 
    'RECORD_UPDATED'=>'تم تعديل الحقل',
    ''=>'',
    ''=>'',
    // end update page

    // start add new member 
    'ADD_MEMBER'             =>'اضافة عضو جديد',
    'MEMBER_ADD_PASS'        =>'كلمة المرور',
    'ADD_MEMBER_confirm_PASS'=>'تاكيد كلمة المرور',
    'RECORD_ADDED'           =>'تم اضافة حقل جديد',
    // 3END add new member 
    
    // START DELETE PAGE 
    
    'RECORD_DELETED'           =>'تم حذف الحقل',
    // END DELETE PAGE 
    // start activate page 
    
    'RECORD_ACTIVATED'           =>'تم تفعيل الحقل',
    // end activate page 
    // end members page 
    
    // start categories page 
    'ADD_NEW_CATEGORY'           =>'اضافة قسم جديد',
    'CATEGORY_NAME'              =>'اسم القسم ',
    'DESC_OF_CATEGORY'           =>'وصف القسم',
    'ORDER'                      =>'التريب',
    'VISIBLILITY'                =>'اضهار الفئة:',
    'YES'                        =>'نعم',
    'NO'                         =>'لا',
    'ALLOW_COMMENTING'           =>'السماح للتعلقات:',
    'ALLOW_ADS'                  =>'السماح للاعلانات:',
    // SART manage categories page 
    'MANAGE_CATEGORIES'          =>'ادارة الاقسام ',
    'ORDERING:'                  =>'الترتيب:',
    'ASC'                        =>'تصاعدي',
    'DESC'                       =>'تنازلي',
    'OR'                         =>'أو',
    'VIEW:'                      =>'مشاهدة:',
    'CLASSIC'                    =>'تقليدي',
    'FULL'                       =>'كامل',
    'HIDDDEN'                    =>'اخفاء',
    'DESCRIPTION'                =>'وصف:',
    'COMMENT_DISABLE'            =>'الغاء التعليقات',
    'ADS_DISABLE'                =>'الغاء الاعلانات',
    'ADD_NEW_CATEGORIES'         =>'اضافة قسم جديد',
    // end manage categories page 
    // end categories page 
    
    // start items page 
    // start add page 
    'ADD_NEW_ITEM'               =>'اضافة غرض جديد',
    'ITEM_NAME'                  =>'اسم الغرض',
    'PRICE'                      =>'السعر',
    'COUNTRY_OF_MADE'            =>'بلد الصنع',
    'STATUES_OF_ITEM'            =>'حالة الغرض:',
    '...'                        =>'...',
    'NEW'                        =>'جديد',
    'LIKE_NEW'                   =>'شبه جديد',
    'USED'                       =>'مستخدم',
    'OLD'                        =>'قديم',
    'ADD_ITEM'                   =>'اضافة عنصر',
    // end add page 
    // START MANAGE ITEMS 
    'MANAGE_ITEMS'               =>'ادارة الاغراض',
    'NAME'                       =>'الاسم',
    'DESCRIPTION'                =>'الوصف',
    'ADDING_DATE'                =>'تاريخ الاضافة',
    'COUNTRY_MADE'               =>'بلد الصنع',
    'STATUS'                     =>'الحاله',
    'SHOW_COMMENTS'              =>'التعليقات',
    'APPROVE'                    =>'قبول',
    'RECORD_APPROVE'             =>'تم قبول الحقل',

    // START MANAGE ITEMS 
    // star insert page 
    
    'MEMBER_WHO_ADD_THE_ITEM'   =>'العضو الذي اضاف العنصر:',
    'CATEGORY_NAME'             =>'اسم القسم:',
    // end insert page 
    // end items page 
    
    // START comments
    'MANAGE_COMMENTS'          =>'ادارة التعليقات',
    'COMMENT'                  =>'التعليق',
    'ITEM_NAME'                =>'اسم الغرض',
    'COMMENT_DATE'             =>'تاريخ التعليق',
    'EDIT_COMMENT'             =>'تعديل التعليق',
    'ENTER_YOUR_COMMENT'       =>'ادخل تعليقك:',
    'THERE_IS_NO_COMMENTS'     =>'لا يوجد تعليقات علي هذا الغرض',
    'LASTES_COMMENTS'          =>'اخر التعليقات',
    // end comments 
    
    
    // start main website 
    // start index page 
    'HOME'                  =>'الرئسية',




    // end index page 
    // end main website 
);
    return $langs[$phr];
 }
?>