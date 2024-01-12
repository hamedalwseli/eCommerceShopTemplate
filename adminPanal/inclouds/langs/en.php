<?php
 function lang($phr){

static $langs =array(
    'SORRY_YOU_CANT_BROWSE_THIS_PAGE_DIERECTLY'    =>'sorry you cant browse this page directly',
    'THERE_IS_AN_ERROR'    =>'there is An error',
    // strat index or login page
    'ADMIN_LOGIN'        =>'admin login',
    'USER_NAME'          =>'user name',
    'PASSWORD'           =>'password',
    'FORGET_THE_PASSOWRD'=>'forgin the password?',
    ''=>'',
    // end index or login page
    // start navbar    
    'ADMIN_HOME'  =>'Admin',
    '_HOME'       =>'Home',
    'CATEGORIES'  =>'Categories',
    'LOGOUT'      =>'Logout',
    'EDIT_PROFILE'=>'Edit Profile',
    'SETTINGS'    =>'Settings',
    'VISIT_OUR_SHOP' =>'visit out shop',
    'ITEMS'       =>'Items',
    'MEMBERS'     =>'Members',
    'STATISTIC'   =>'Statistics',
    'COMMENTS'    =>'comments',
    'LOGS'        =>'Logs',
    // end navbar 
    
    // start dashboard page
    'DASHBOARD'        =>'dashboard',
    'TOTAL_MEMBERS'    =>'total members',
    'PENDING_MEMBERS'  =>'pending members',
    'TOTAL_ITEMS'      =>'total items',
    'TOTAL_COMMENTS'   =>'total comments',
    'LASTES_USERS'     =>'lastes users',
    'LASTES_ITEMS'     =>'lastes items',
    // end dashboard page

    // start members page 
    // START MANAGE PAGE 
    'MANAGE_MEMBERS'        =>'manage members ',
    '#ID'                   =>'#ID',
    'EMAIL'                 =>'email',
    'FULL_NAME'             =>'full name',
    'REGISTER_DATE'         =>'register date',
    'CONTROL'               =>'control',
    'EDIT'                  =>'Edit',
    'DELETE'                =>'delete',
    'ACTIVATE'                =>'activate',
    
    // END MANAGE PAGE 
    // START insert member page 
    'USER_EXSIST'           =>'sorry, this user is exists alrady',
    
    // end insert member page 
    // start edit member page 
    'EDIT_MEMBERS'       =>'Edit Members',
    'EDIT_MEMBER'        =>'Edit profile',
    'MEMBER_USER_NAME'   =>' UserName',
    'MEMBER_PASS'        =>'New Password',
    'MEMBER_confirm_PASS'=>'Confrim New Password',
    'USERNAME_EMPTY'     =>'you have to fill user name',
    'NOT_MATCH_PASS'     =>'not match password',
    'EMAIL_MEMBER'       =>'email',
    'EMAIL_EMPTY'        =>'you have to insert email ',
    'MEMBER_FILL_NAME'   =>' Full Name',
    'FULLNAME_EMPTY'     =>'you have to fill full name ',

    // end edit member page 

    // start update page 
    'RECORD_UPDATED'=>'Recrod Udated',
    ''=>'',
    ''=>'',
    // end update page

    // start add new member 
    'ADD_MEMBER'             =>'Add new member',
    'MEMBER_ADD_PASS'        =>'password',
    'ADD_MEMBER_confirm_PASS'=>'Confrim password',
    'RECORD_ADDED'           =>'record added',
    // 3END add new member 
    
    // START DELETE PAGE 
    
    'RECORD_DELETED'           =>'record deleted',
    // END DELETE PAGE 
    // start activate page 
    
    'RECORD_ACTIVATED'           =>'record activated',
    // end activate page 
    // end members page 
    
    // start categories page 
    'ADD_NEW_CATEGORY'           =>'add new category',
    'CATEGORY_NAME'              =>'name of category',
    'DESC_OF_CATEGORY'           =>'description of categroy',
    'ORDER'                      =>'ordering',
    'VISIBLILITY'                =>'visiblility of the category:',
    'YES'                        =>'yes',
    'NO'                         =>'no',
    'ALLOW_COMMENTING'           =>'allow commenting:',
    'ALLOW_ADS'                  =>'allow ads:',
    'EDIT_CATEGORY'                  =>'edit categery',
    // SART manage categories page 
    'MANAGE_CATEGORIES'          =>'Manage categories',
    'ORDERING:'                  =>'ordering:',
    'ASC'                        =>'ASC',
    'DESC'                       =>'DESC',
    'OR'                         =>'or',
    'VIEW:'                      =>'view:',
    'CLASSIC'                    =>'calssic',
    'FULL'                       =>'full',
    'HIDDDEN'                    =>'hidden',
    'DESCRIPTION'                =>'discription:',
    'COMMENT_DISABLE'            =>'comment disable',
    'ADS_DISABLE'                =>'ads disable',
    'ADD_NEW_CATEGORIES'         =>'add new categories',
    // end manage categories page 
    // end categories page 
    
    // start items page 
    // start add page 
    'ADD_NEW_ITEM'               =>'add new item',
    'ITEM_NAME'                  =>'item name',
    'PRICE'                      =>'price',
    'COUNTRY_OF_MADE'            =>'country of made',
    'STATUES_OF_ITEM'            =>'statues of item:',
    '...'                        =>'...',
    'NEW'                        =>'new',
    'LIKE_NEW'                   =>'like new',
    'USED'                       =>'used',
    'OLD'                        =>'old',
    'ADD_ITEM'                   =>'add item',
    // end add page 
    // START MANAGE ITEMS 
    'MANAGE_ITEMS'               =>'manage items',
    'NAME'                       =>'name',
    'DESCRIPTION'                =>'description',
    'ADDING_DATE'                =>'adding date',
    'COUNTRY_MADE'               =>'country made',
    'STATUS'                     =>'statues',
    'SHOW_COMMENTS'              =>'comments',
    'APPROVE'                    =>'approve',
    'RECORD_APPROVE'             =>'recored approve',

    // START MANAGE ITEMS 
    // star insert page 
    
    'MEMBER_WHO_ADD_THE_ITEM'   =>'member who add the item:',
    'CATEGORY_NAME'             =>'category name:',
    // end insert page 
    // end items page 
    
    // START comments
    'MANAGE_COMMENTS'          =>'manage comments',
    'COMMENT'                  =>'comment',
    'ITEM_NAME'                =>'item name',
    'COMMENT_DATE'             =>'comment date',
    'EDIT_COMMENT'             =>'edit comment',
    'ENTER_YOUR_COMMENT'       =>'enter your comment:',
    'THERE_IS_NO_COMMENTS'     =>'there is no comments of this item',
    'LASTES_COMMENTS'          =>'latest comments',
    
    // end comments 
    'AVATAR'                   =>'avatar',
);
    return $langs[$phr];
 }
?>