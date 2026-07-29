
--------------------------------------------------------------------------------
> Time: 1435797824 / Thu, 02 Jul 2015 00:43:44 +0000
> URL: /index.php?/REST/core/registration/checkEmail?email=Danira.Rubio%40gmail.com
> User Guest (0)
array (
  '/REST/core/registration/checkEmail?email' => 'Danira.Rubio@gmail.com',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'registration',
  'operation' => 'checkEmail',
  'email' => 'Danira.Rubio%40gmail.com',
  'last_visit' => 1435797824,
)
--------------------------------------------------------------------------------
> Time: 1435797824 / Thu, 02 Jul 2015 00:43:44 +0000
> URL: /index.php?/REST/core/registration/checkEmail?email=Danira.Rubio%40gmail.com
> User Guest (0)
Request Time: 0 seconds
{"Success":true,"Data":true,"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797837 / Thu, 02 Jul 2015 00:43:57 +0000
> URL: /index.php?/REST/core/registration/checkUsername?username=xoxdaniraxox
> User Guest (0)
array (
  '/REST/core/registration/checkUsername?username' => 'xoxdaniraxox',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'registration',
  'operation' => 'checkUsername',
  'username' => 'xoxdaniraxox',
  'last_visit' => 1435797837,
)
--------------------------------------------------------------------------------
> Time: 1435797837 / Thu, 02 Jul 2015 00:43:57 +0000
> URL: /index.php?/REST/core/registration/checkUsername?username=xoxdaniraxox
> User Guest (0)
Request Time: 0 seconds
{"Success":true,"Data":true,"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797857 / Thu, 02 Jul 2015 00:44:17 +0000
> URL: /index.php?/REST/core/registration
> User Guest (0)
array (
  '/REST/core/registration' => '',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'post',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'registration',
  'operation' => '',
  'email' => 'Danira.Rubio@gmail.com',
  'username' => 'eG94ZGFuaXJheG94',
  'password' => 'U3VtbWVyMDU=',
  'last_visit' => 1435797857,
)
--------------------------------------------------------------------------------
> Time: 1435797858 / Thu, 02 Jul 2015 00:44:18 +0000
> URL: /index.php?/REST/core/registration
> User Guest (0)
Request Time: 1 seconds
{"Success":true,"Data":{"Status":"PendingEmailValidation","Message":"An activation code has been sent to your email address. Please click on the link in the email to complete the registration process."},"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
array (
  '/REST/core/authenticate' => '',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'authenticate',
  'operation' => '',
  'last_visit' => 1435797878,
)
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
Request Time: 0 seconds
{"Success":true,"Data":{"SessionId":"01f45cd8c64cb8207c3230fb71907d43","RenewalKey":"4e68c31695ae916099f26373a0c54f5d"},"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Forums/all?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/Forums/all?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'Forums',
  'class' => 'all',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Users/user?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/Users/user?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'Users',
  'class' => 'user',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Users/user?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":{"Title":"","SecondaryGroups":"","TotalPosts":0,"LastPostDate":0,"LastVisitDate":1435797857,"LastActivityDate":1435797878,"TotalProfileViews":0,"TimeOffset":-8,"DaylightSavingsOn":false,"WarningLevel":0,"LastWarningDate":0,"IsRestricted":false,"RequiresModeration":false,"IsBanned":false,"ShowSignatures":true,"ShowImages":true,"BdayMonth":0,"BdayDay":0,"BdayYear":0,"Notifications":{"New":0,"Total":0,"ShowNotifications":true},"NewMessages":0,"TotalMessages":0,"Signature":"","Email":"danira.rubio@gmail.com","IpAddress":"107.140.84.238","GroupId":1,"GroupName":"Validating","JoinDate":1435797857,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"xoxdaniraxox","Id":283785,"Name":"xoxdaniraxox","IsOnline":true},"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Users/user?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/Users/user?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'Users',
  'class' => 'user',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Users/user?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":{"Title":"","SecondaryGroups":"","TotalPosts":0,"LastPostDate":0,"LastVisitDate":1435797857,"LastActivityDate":1435797878,"TotalProfileViews":0,"TimeOffset":-8,"DaylightSavingsOn":false,"WarningLevel":0,"LastWarningDate":0,"IsRestricted":false,"RequiresModeration":false,"IsBanned":false,"ShowSignatures":true,"ShowImages":true,"BdayMonth":0,"BdayDay":0,"BdayYear":0,"Notifications":{"New":0,"Total":0,"ShowNotifications":true},"NewMessages":0,"TotalMessages":0,"Signature":"","Email":"danira.rubio@gmail.com","IpAddress":"107.140.84.238","GroupId":1,"GroupName":"Validating","JoinDate":1435797857,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"xoxdaniraxox","Id":283785,"Name":"xoxdaniraxox","IsOnline":true},"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797878 / Thu, 02 Jul 2015 00:44:38 +0000
> URL: /index.php?/REST/Forums/all?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Id":96,"Name":"Destination Wedding Forum","ParentId":"root","Password":"","IconUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/f_icon.png","Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":false},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Forums":[{"FullName":"BDW General","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":4,"TotalTopics":19535,"TotalPosts":332431,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":278581,"Name":"beckys98","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":78768,"Title":"Tinkersofi's Planning T...","LastPostDate":1435794105},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":14,"Name":"Newbies!!","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":14,"Name":"Newbies!!","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":28,"Name":"Forum News & Updates","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":32,"Name":"Honeymoon Forum","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":37,"Name":"Share your Wedding & Engagement Stories!","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":1,"Name":"BDW General","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"General Wedding Planning Information","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":10,"TotalTopics":21330,"TotalPosts":392960,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":1,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":278581,"Name":"beckys98","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":79333,"Title":"After The Wedding!","LastPostDate":1435777155},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":33,"Name":"Destination Wedding Dresses, Wedding Attire & rings","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":33,"Name":"Destination Wedding Dresses, Wedding Attire & rings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":34,"Name":"Wedding Invitations, Passport Invitations, Boarding Pass Invitations, STDs, photos & website","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":43,"Name":"Wedding Flowers, decoration, cake, etc.","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":44,"Name":"Wedding Registry, Wedding Gift Bags, and OOT bags","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":45,"Name":"Wedding Music & Entertainment","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":57,"Name":"Destination Wedding Articles","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":60,"Name":"Wedding Etiquette, Traditions, to dos","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":74,"Name":"DIY Forum: Passport Invitation Template, Boarding Pass Invitation Templates and more ","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":93,"Name":"At Home Reception (AHR)","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":97,"Name":"Blog Archive","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":7,"Name":"General Wedding Planning Information","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"FullName":"BDW Classifieds","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":4,"TotalTopics":4966,"TotalPosts":29868,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":278581,"Name":"beckys98","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":79339,"Title":"Blush Vera Wang Dress For S...","LastPostDate":1435793005},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":124,"Name":"Travel Deals","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":124,"Name":"Travel Deals","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":67,"Name":"Destination Wedding Vendors","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":98,"Name":"Buy, Sell, Trade or Freebies!","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":26,"Name":"Buy \/ Sell \/ Trade Archives","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":99,"Name":"BDW Classifieds","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"Destination Weddings in Mexico","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":4,"TotalTopics":10443,"TotalPosts":261206,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":270981,"Name":"MrsRobertson","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":"none"},"IsOnline":true},"LastTopic":{"Id":71717,"Title":"Riu Palace Peninsula 2013 B...","LastPostDate":1435793085},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":2,"Name":"Destination Wedding in Riviera Maya, Cancun & surrounding areas","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":2,"Name":"Destination Wedding in Riviera Maya, Cancun & surrounding areas","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":38,"Name":"Destination Wedding in Cabo","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":3,"Name":"Destination Weddings in Puerto Vallarta & surrounding areas","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":5,"Name":"Other areas of Mexico Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":15,"Name":"Destination Weddings in Mexico","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"Destination Weddings in the Caribbean","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":5,"TotalTopics":7970,"TotalPosts":132745,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":283782,"Name":"MrandMrsHill","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":76767,"Title":"Kukua Beach Club Brides (20...","LastPostDate":1435787757},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":22,"Name":"Destination Weddings in Dominican Republic","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":22,"Name":"Destination Weddings in Dominican Republic","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":23,"Name":"Destination Weddings in Jamaica","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":89,"Name":"Sandals, Beaches, and Royal Plantation Resorts Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":25,"Name":"The Islands Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":70,"Name":"Central & South America Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":17,"Name":"Destination Weddings in the Caribbean","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"United States (incl. Hawaii) Weddings","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":5,"TotalTopics":1385,"TotalPosts":7811,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":282964,"Name":"samwillow","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-282964.jpg?_r=1431149209","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":77028,"Title":"Disney Bride","LastPostDate":1435239861},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":16,"Name":"Destination Weddings in Hawaii","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":16,"Name":"Destination Weddings in Hawaii","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":31,"Name":"Destination Weddings in Las Vegas","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":35,"Name":"Florida Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":36,"Name":"California Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":86,"Name":"East Coast Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":30,"Name":"United States (incl. Hawaii) Weddings","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"Cruise Weddings","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":1,"TotalTopics":329,"TotalPosts":2659,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":282530,"Name":"hoanganh9o0","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":73377,"Title":"Cruise Wedding","LastPostDate":1427279086},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":false,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":88,"Name":"Cruise Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":88,"Name":"Cruise Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":87,"Name":"Cruise Weddings","IsCategory":true,"IsFollowing":false,"CanFollow":true},{"FullName":"Brides Roll Call","ParentId":"96","Password":"","PasswordOverride":"","Description":"","TotalSubForums":0,"TotalTopics":172,"TotalPosts":20879,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":1,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":232000,"Name":"acw271011","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-232000.jpg?_r=1434318164","PhotoWidth":570,"PhotoHeight":541,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":79226,"Title":"How Long Are You Going For?","LastPostDate":1433881481},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":null,"SubForums":[],"Topics":[],"Id":101,"Name":"Brides Roll Call","IsCategory":false,"IsFollowing":false,"CanFollow":true}]},{"Id":130,"Name":"Ladies Lounge","ParentId":"root","Password":"","IconUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/f_icon.png","Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Forums":[{"FullName":"Chit Chat Corner!","ParentId":"130","Password":"","PasswordOverride":"","Description":"","TotalSubForums":5,"TotalTopics":6594,"TotalPosts":189710,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":1,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":277873,"Name":"calgarybride2015","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-277873.jpg?_r=1422218225","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":79338,"Title":"Maid Of Honour Fail?","LastPostDate":1435770963},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":13,"Name":"Just venting or funnies","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":13,"Name":"Just venting or funnies","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":27,"Name":"Celebrity Gossip!","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":39,"Name":"Beauty, Exercise, Diet","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":56,"Name":"Random Thoughts","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":61,"Name":"Martha Stewart Wannabees!","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":29,"Name":"Chit Chat Corner!","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"FullName":"Family and Parenting","ParentId":"130","Password":"","PasswordOverride":"","Description":"","TotalSubForums":4,"TotalTopics":40,"TotalPosts":3172,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":276748,"Name":"diadiamond","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-276748.jpg?_r=1392867144","PhotoWidth":200,"PhotoHeight":267,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":79135,"Title":"Help!  I Was Diagnosed With...","LastPostDate":1431206207},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":false,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":{"Id":109,"Name":"Trying to Conceive","IsCategory":false,"IsFollowing":false,"CanFollow":true},"SubForums":[{"Id":109,"Name":"Trying to Conceive","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":110,"Name":"Pregnancy","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":111,"Name":"Mommyhood","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"Id":112,"Name":"Step-family","IsCategory":false,"IsFollowing":false,"CanFollow":true}],"Topics":[],"Id":108,"Name":"Family and Parenting","IsCategory":true,"IsFollowing":false,"CanFollow":true}]},{"Id":115,"Name":"Social Groups","ParentId":"root","Password":"","IconUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/f_icon.png","Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":false},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Forums":[{"FullName":"Dreams Los Cabos Weddings","ParentId":"115","Password":null,"PasswordOverride":null,"Description":"","TotalSubForums":0,"TotalTopics":24,"TotalPosts":217,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":276338,"Name":"kellymiller","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"LastTopic":{"Id":79264,"Title":"Vendor Fees","LastPostDate":1434064266},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":null,"SubForums":[],"Topics":[],"Id":118,"Name":"Dreams Los Cabos Weddings","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"FullName":"Pregnancy Group: A place to chat about all things related to pregnancy","ParentId":"115","Password":null,"PasswordOverride":null,"Description":"","TotalSubForums":0,"TotalTopics":7,"TotalPosts":112,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":278603,"Name":"Sabes44","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-278603.jpg?_r=1405559586","PhotoWidth":200,"PhotoHeight":200,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":65491,"Title":"Maternity Photos","LastPostDate":1406328280},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":false,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":null,"SubForums":[],"Topics":[],"Id":121,"Name":"Pregnancy Group: A place to chat about all things related to pregnancy","IsCategory":false,"IsFollowing":false,"CanFollow":true},{"FullName":"Canadian Destination Wedding Group","ParentId":"115","Password":"","PasswordOverride":"","Description":"","TotalSubForums":0,"TotalTopics":34,"TotalPosts":680,"QueuedTopics":0,"QueuedPosts":0,"DeletedTopics":0,"DeletedPosts":0,"ArchivedTopics":0,"ArchivedPosts":0,"LastPoster":{"Id":279604,"Name":"Andrea2015","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":"custom"},"IsOnline":false},"LastTopic":{"Id":79291,"Title":"Calgary Brides\/ Bridesmaid...","LastPostDate":1434748382},"ShowForumRules":false,"ForumRulesTitle":"","ForumRulesText":"","RedirectUrl":"","RedirectOn":false,"RedirectHits":0,"LastUnread":"","HasUnread":true,"Permissions":[{"Type":"view","IsEnabled":true},{"Type":"read","IsEnabled":true},{"Type":"reply","IsEnabled":false},{"Type":"start","IsEnabled":false},{"Type":"upload","IsEnabled":false},{"Type":"download","IsEnabled":false}],"Announcements":[],"FirstSubForum":null,"SubForums":[],"Topics":[],"Id":129,"Name":"Canadian Destination Wedding Group","IsCategory":false,"IsFollowing":false,"CanFollow":true}]}],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797915 / Thu, 02 Jul 2015 00:45:15 +0000
> URL: /index.php?/REST/Forums/forum/getTopics?forumId=129&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/Forums/forum/getTopics?forumId' => '129',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'Forums',
  'class' => 'forum',
  'operation' => 'getTopics',
  'forumId' => '129',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797916 / Thu, 02 Jul 2015 00:45:16 +0000
> URL: /index.php?/REST/Forums/forum/getTopics?forumId=129&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 1 seconds
{"Success":true,"Data":[{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":7,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":true,"HasAttachments":false,"Views":499,"MovedTo":null,"MovedOn":0,"FirstPostId":1898856,"Rating":0,"RatingHits":0,"Starter":{"Id":279604,"Name":"Andrea2015","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":"custom"},"IsOnline":false},"StartDate":1434648314,"LastPoster":{"Id":279604,"Name":"Andrea2015","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1898856,"PostDate":1434648314,"PostContent":"Hello all, I just wanted to share my experience at Cameo & Cufflinks in Calgary with you as I am...","Author":{"Signature":"","Email":"andreacorsi2012@gmail.com","IpAddress":"174.0.176.157","GroupId":39,"GroupName":"Newbie","JoinDate":1409190369,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":"custom"},"FormattedName":"Andrea2015","Id":279604,"Name":"Andrea2015","IsOnline":false}},"Posts":[],"Id":"79291","Title":"Calgary Brides\/ Bridesmaid Dress Nightmare","LastPostDate":1434748382},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":17,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1733,"MovedTo":null,"MovedOn":0,"FirstPostId":1870913,"Rating":0,"RatingHits":0,"Starter":{"Id":276860,"Name":"Maggietron","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1410124573,"LastPoster":{"Id":283167,"Name":"yycbride2016","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-283167.jpg?_r=1432133572","PhotoWidth":200,"PhotoHeight":133,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1870913,"PostDate":1410124573,"PostContent":"This question is rather Canadian-specific because of the way our packages are structured. We're p...","Author":{"Signature":"","Email":"magscharron@gmail.com","IpAddress":"64.141.11.150","GroupId":40,"GroupName":"Jr. Member","JoinDate":1393267130,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"Maggietron","Id":276860,"Name":"Maggietron","IsOnline":false}},"Posts":[],"Id":"77967","Title":"Save The Dates And Invitations?","LastPostDate":1432736372},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":12,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":871,"MovedTo":null,"MovedOn":0,"FirstPostId":1877298,"Rating":0,"RatingHits":0,"Starter":{"Id":279087,"Name":"Msmimi","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1414628900,"LastPoster":{"Id":281283,"Name":"vancouverpetunia","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-281283.jpg?_r=1428779369","PhotoWidth":200,"PhotoHeight":200,"PhotoType":"custom"},"IsOnline":true},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1877298,"PostDate":1414628900,"PostContent":"Looking for a great travel agent in Edmonton and wondering what your thoughts are on dealing with...","Author":{"Signature":"","Email":"njwood000@gmail.com","IpAddress":"71.7.173.185","GroupId":40,"GroupName":"Jr. Member","JoinDate":1405824791,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"Msmimi","Id":279087,"Name":"Msmimi","IsOnline":false}},"Posts":[],"Id":"78312","Title":"Online\/phone Vs In-Person Travel Agent","LastPostDate":1432355272},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":10,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1358,"MovedTo":null,"MovedOn":0,"FirstPostId":1837120,"Rating":0,"RatingHits":0,"Starter":{"Id":276748,"Name":"diadiamond","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-276748.jpg?_r=1392867144","PhotoWidth":200,"PhotoHeight":267,"PhotoType":"custom"},"IsOnline":false},"StartDate":1394201900,"LastPoster":{"Id":265511,"Name":"TinkerSofi","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-265511.jpg?_r=1427386564","PhotoWidth":200,"PhotoHeight":153,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1837120,"PostDate":1394201900,"PostContent":"Hi Everyone! \u00a0 I went to the Toronto Destination Wedding and Honeymoon expo last night hosted by...","Author":{"Signature":"<div><br><div>\u00a0<\/div>\n<div><a  class=\"bbc_url\" href=\"http:\/\/www.TickerFactory.com\/\"><img src=\"http:\/\/tickers.TickerFactory.com\/ezt\/d\/4;10732;484\/st\/20150924\/e\/Our+Wedding\/k\/8745\/event.png\" alt=\"event.png\"><\/a><\/div>\n<div>\u00a0<\/div>\n<\/div>\n<div>\u00a0<\/div>\n<div>My Planning Thread:<\/div>\n<div>\u00a0<\/div>\n<div><a data-ipb='nomediaparse' href='http:\/\/www.bestdestinationwedding.com\/topic\/79153-diadiamonds-planning-thread-iberostar-varadero-cuba-sept242015\/'>http:\/\/www.bestdestinationwedding.com\/topic\/79153-diadiamonds-planning-thread-iberostar-varadero-cuba-sept242015\/<\/a><\/div>\n<div>\u00a0<\/div>\n<div>\u00a0<\/div>\n","Email":"fadia.daniel@gmail.com","IpAddress":"76.64.81.211","GroupId":40,"GroupName":"Jr. Member","JoinDate":1392664043,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-276748.jpg?_r=1392867144","PhotoWidth":200,"PhotoHeight":267,"PhotoType":"custom"},"FormattedName":"diadiamond","Id":276748,"Name":"diadiamond","IsOnline":false}},"Posts":[],"Id":"76536","Title":"Has Anyone Used Romantic Planet To Plan Your Destination Wedding?","LastPostDate":1430762518},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":4,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":482,"MovedTo":null,"MovedOn":0,"FirstPostId":1853307,"Rating":0,"RatingHits":0,"Starter":{"Id":274116,"Name":"SamanthaC","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-274116.jpg?_r=1401456666","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"StartDate":1401729562,"LastPoster":{"Id":276748,"Name":"diadiamond","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-276748.jpg?_r=1392867144","PhotoWidth":200,"PhotoHeight":267,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1853307,"PostDate":1401729562,"PostContent":"Anyone getting married in Cuba next year?","Author":{"Signature":"","Email":"sammy_frog63@hotmail.com","IpAddress":"72.38.55.174","GroupId":39,"GroupName":"Newbie","JoinDate":1381339881,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-274116.jpg?_r=1401456666","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"FormattedName":"SamanthaC","Id":274116,"Name":"SamanthaC","IsOnline":false}},"Posts":[],"Id":"77207","Title":"Cuba 2015 Weddings?","LastPostDate":1430584800},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":15,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1717,"MovedTo":null,"MovedOn":0,"FirstPostId":1880768,"Rating":0,"RatingHits":0,"Starter":{"Id":276338,"Name":"kellymiller","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1418936158,"LastPoster":{"Id":281523,"Name":"emmapalmer","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1880768,"PostDate":1418936158,"PostContent":"Hi Ladies, \u00a0 With the Canadian dollar being so low right now, does anyone know of a credit card w...","Author":{"Signature":"","Email":"kelly_miller_@hotmail.com","IpAddress":"99.249.122.85","GroupId":40,"GroupName":"Jr. Member","JoinDate":1390772931,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"kellymiller","Id":276338,"Name":"kellymiller","IsOnline":false}},"Posts":[],"Id":"78495","Title":"Credit Card With Good Foreign Exchange Rate","LastPostDate":1430325606},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":33,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1943,"MovedTo":null,"MovedOn":0,"FirstPostId":1885135,"Rating":0,"RatingHits":0,"Starter":{"Id":279721,"Name":"Wafflesmom","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"StartDate":1423024482,"LastPoster":{"Id":279721,"Name":"Wafflesmom","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1885135,"PostDate":1423024482,"PostContent":"I've seen posts for Manitoba, Saskatchewan and Toronto brides but nothing for Vancouver or any ot...","Author":{"Signature":"<p><a class='bbc_url' href='http:\/\/www.TickerFactory.com\/'><br><img src=\"http:\/\/tickers.TickerFactory.com\/ezt\/d\/4;4;484\/st\/20160123\/e\/Our+Wedding\/dt\/-2\/k\/44c5\/event.png\" alt=\"event.png\"><br><\/a><br>\u00a0","Email":"jerilee.valenzuela@shaw.ca","IpAddress":"24.114.26.77","GroupId":40,"GroupName":"Jr. Member","JoinDate":1410098585,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"FormattedName":"Wafflesmom","Id":279721,"Name":"Wafflesmom","IsOnline":false}},"Posts":[],"Id":"78730","Title":"2015\/2016 Vancouver (Or Anywhere From Bc) Brides","LastPostDate":1428984787},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":40,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":2167,"MovedTo":null,"MovedOn":0,"FirstPostId":1875714,"Rating":0,"RatingHits":0,"Starter":{"Id":276860,"Name":"Maggietron","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1413320512,"LastPoster":{"Id":206696,"Name":"TammyWright","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-206696.jpg?_r=1386394555","PhotoWidth":200,"PhotoHeight":135,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1875714,"PostDate":1413320512,"PostContent":"How long did it take you to get responses to your initial inquiries to travel agents? I emailed L...","Author":{"Signature":"","Email":"magscharron@gmail.com","IpAddress":"64.141.11.150","GroupId":40,"GroupName":"Jr. Member","JoinDate":1393267130,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"Maggietron","Id":276860,"Name":"Maggietron","IsOnline":false}},"Posts":[],"Id":"78218","Title":"Travel Agent Response Time?","LastPostDate":1428711891},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":24,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1342,"MovedTo":null,"MovedOn":0,"FirstPostId":1873799,"Rating":0,"RatingHits":0,"Starter":{"Id":276860,"Name":"Maggietron","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1412093739,"LastPoster":{"Id":282693,"Name":"babygirl99","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1873799,"PostDate":1412093739,"PostContent":"So from what I'm hearing here, once you lock in your rates, you have 30 days to put down deposits...","Author":{"Signature":"","Email":"magscharron@gmail.com","IpAddress":"64.141.11.150","GroupId":40,"GroupName":"Jr. Member","JoinDate":1393267130,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"Maggietron","Id":276860,"Name":"Maggietron","IsOnline":false}},"Posts":[],"Id":"78120","Title":"Timing The Invitations With Canadian Travel Packages","LastPostDate":1428698849},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":59,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":true,"Views":2488,"MovedTo":null,"MovedOn":0,"FirstPostId":1889522,"Rating":0,"RatingHits":0,"Starter":{"Id":282430,"Name":"IzzyDeee","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-282430.jpg?_r=1434377756","PhotoWidth":200,"PhotoHeight":287,"PhotoType":"custom"},"IsOnline":false},"StartDate":1426554060,"LastPoster":{"Id":282406,"Name":"Lisa35","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-282406.jpg?_r=1426179017","PhotoWidth":177,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1889522,"PostDate":1426554060,"PostContent":"Wondering if there are any other brides from Ontario Canada setting off for a destination wedding...","Author":{"Signature":"","Email":"izabella.david@gmail.com","IpAddress":"99.237.26.51","GroupId":40,"GroupName":"Jr. Member","JoinDate":1426462378,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-282430.jpg?_r=1434377756","PhotoWidth":200,"PhotoHeight":287,"PhotoType":"custom"},"FormattedName":"IzzyDeee","Id":282430,"Name":"IzzyDeee","IsOnline":false}},"Posts":[],"Id":"78921","Title":"Any Ontario Brides To Be Of 2015?!","LastPostDate":1428601087},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":40,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":3573,"MovedTo":null,"MovedOn":0,"FirstPostId":1843890,"Rating":0,"RatingHits":0,"Starter":{"Id":277296,"Name":"tygrrlily","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-277296.jpg?_r=1421643766","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"StartDate":1397228568,"LastPoster":{"Id":282430,"Name":"IzzyDeee","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-282430.jpg?_r=1434377756","PhotoWidth":200,"PhotoHeight":287,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1843890,"PostDate":1397228568,"PostContent":"Looks like there are a bunch of girls from Calgary. Any other Toronto\/GTA brides out there? It'd...","Author":{"Signature":"<p>Married December 19, 2014 at Beach Palace Resort in Cancun, Mexico<\/p>\n<p>\u00a0<\/p>\n<p>My Planning Thread - <a data-ipb='nomediaparse' href='http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/'>http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/<\/a><\/p>\n<p>\u00a0<\/p>\n<p>My Wedding Review<\/p>\n<p>Part 1 - <a data-ipb='nomediaparse' href='http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881197'>http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881197<\/a><\/p>\n<p>Part 2 - <a data-ipb='nomediaparse' href='http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881590'>http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881590<\/a><\/p>\n<p>Part 3 - <a data-ipb='nomediaparse' href='http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881861'>http:\/\/www.bestdestinationwedding.com\/topic\/77763-tygrrlilys-planning-thread-beach-palace-resort-121914\/?p=1881861<\/a><\/p>\n<p>\u00a0","Email":"lilyluu83@gmail.com","IpAddress":"174.119.162.30","GroupId":3,"GroupName":"Member","JoinDate":1395609348,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-277296.jpg?_r=1421643766","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"FormattedName":"tygrrlily","Id":277296,"Name":"tygrrlily","IsOnline":false}},"Posts":[],"Id":"76821","Title":"Toronto Area 2014\/2015 Brides","LastPostDate":1427746748},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":28,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1975,"MovedTo":null,"MovedOn":0,"FirstPostId":1874451,"Rating":0,"RatingHits":0,"Starter":{"Id":280238,"Name":"kimmyd2","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-280238.png?_r=1412619945","PhotoWidth":80,"PhotoHeight":60,"PhotoType":"custom"},"IsOnline":false},"StartDate":1412617572,"LastPoster":{"Id":279143,"Name":"Smellsey","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279143.jpg?_r=1411496026","PhotoWidth":200,"PhotoHeight":150,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1874451,"PostDate":1412617572,"PostContent":"Hi! Looking for any Manitoba or Winnipeg brides to be out there?? Would love to connect with you,...","Author":{"Signature":"<p><span style=\"color:#cc6666;\"><span style=\"font-family:georgia, serif;\"><em>Forever can never be long enough for me, to feel like I've had long enough with you...19\/01\/2016<\/em><\/span><\/span>","Email":"kimberlydiana@hotmail.com","IpAddress":"24.76.172.36","GroupId":39,"GroupName":"Newbie","JoinDate":1412304687,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-280238.png?_r=1412619945","PhotoWidth":80,"PhotoHeight":60,"PhotoType":"custom"},"FormattedName":"kimmyd2","Id":280238,"Name":"kimmyd2","IsOnline":false}},"Posts":[],"Id":"78164","Title":"Winnipeg\/manitoba Brides?","LastPostDate":1426518157},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":21,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1499,"MovedTo":null,"MovedOn":0,"FirstPostId":1881546,"Rating":0,"RatingHits":0,"Starter":{"Id":276338,"Name":"kellymiller","Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"IsOnline":false},"StartDate":1420241376,"LastPoster":{"Id":277873,"Name":"calgarybride2015","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-277873.jpg?_r=1422218225","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1881546,"PostDate":1420241376,"PostContent":"Hi All, \u00a0 We booked our flights with Air Transat and now I have some questions about carry on lug...","Author":{"Signature":"","Email":"kelly_miller_@hotmail.com","IpAddress":"99.249.122.85","GroupId":40,"GroupName":"Jr. Member","JoinDate":1390772931,"Photo":{"HasPhoto":false,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/public\/style_images\/destination\/profile\/default_large.png","PhotoWidth":125,"PhotoHeight":125,"PhotoType":""},"FormattedName":"kellymiller","Id":276338,"Name":"kellymiller","IsOnline":false}},"Posts":[],"Id":"78530","Title":"Air Transat Carry On Luggage","LastPostDate":1423025158},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":13,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":1265,"MovedTo":null,"MovedOn":0,"FirstPostId":1870930,"Rating":0,"RatingHits":0,"Starter":{"Id":279721,"Name":"Wafflesmom","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"StartDate":1410128726,"LastPoster":{"Id":279721,"Name":"Wafflesmom","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1870930,"PostDate":1410128726,"PostContent":"Hi everyone, I've posted this on the newbie forum but thought it would be more appropriate to pos...","Author":{"Signature":"<p><a class='bbc_url' href='http:\/\/www.TickerFactory.com\/'><br><img src=\"http:\/\/tickers.TickerFactory.com\/ezt\/d\/4;4;484\/st\/20160123\/e\/Our+Wedding\/dt\/-2\/k\/44c5\/event.png\" alt=\"event.png\"><br><\/a><br>\u00a0","Email":"jerilee.valenzuela@shaw.ca","IpAddress":"24.114.26.77","GroupId":40,"GroupName":"Jr. Member","JoinDate":1410098585,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279721.jpg?_r=1431039162","PhotoWidth":200,"PhotoHeight":300,"PhotoType":"custom"},"FormattedName":"Wafflesmom","Id":279721,"Name":"Wafflesmom","IsOnline":false}},"Posts":[],"Id":"77969","Title":"2016 Moon Palace - Price From Vancouver","LastPostDate":1423007902},{"State":"open","OpenTime":0,"CloseTime":0,"IsApproved":true,"IsPinned":false,"IsDeleted":false,"IsHidden":false,"IsArchived":false,"IsFollowing":false,"CanEdit":false,"CanReply":false,"CanFollow":true,"TotalPosts":9,"QueuedPosts":0,"DeletedPosts":0,"HasUnreadPosts":false,"HasAttachments":false,"Views":732,"MovedTo":null,"MovedOn":0,"FirstPostId":1876460,"Rating":0,"RatingHits":0,"Starter":{"Id":279198,"Name":"KAT2015","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279198.jpg?_r=1415031085","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"StartDate":1413921981,"LastPoster":{"Id":277873,"Name":"calgarybride2015","Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-277873.jpg?_r=1422218225","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"IsOnline":false},"PollState":"0","LastVote":0,"ForumId":129,"Preview":{"Id":1876460,"PostDate":1413921981,"PostContent":"Only slightly off topic.... I have had to cancel my destination wedding and move the wedding back...","Author":{"Signature":"","Email":"kelann25@gmail.com","IpAddress":"173.239.125.187","GroupId":39,"GroupName":"Newbie","JoinDate":1406583344,"Photo":{"HasPhoto":true,"PhotoUrl":"http:\/\/bdw.stevewright.netdna-cdn.com\/cdn\/profile\/photo-279198.jpg?_r=1415031085","PhotoWidth":200,"PhotoHeight":134,"PhotoType":"custom"},"FormattedName":"KAT2015","Id":279198,"Name":"KAT2015","IsOnline":false}},"Posts":[],"Id":"78260","Title":"Calgary Area Officiant... Help?","LastPostDate":1420944368}],"Pages":{"TotalItems":34,"TotalPages":3,"CurrentPage":0,"NextPage":15,"PreviousPage":-1,"LastPage":30},"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797916 / Thu, 02 Jul 2015 00:45:16 +0000
> URL: /index.php?/REST/forums/forum/getAnnouncements?forumId=129&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/forums/forum/getAnnouncements?forumId' => '129',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'forums',
  'class' => 'forum',
  'operation' => 'getAnnouncements',
  'forumId' => '129',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797916 / Thu, 02 Jul 2015 00:45:16 +0000
> URL: /index.php?/REST/forums/forum/getAnnouncements?forumId=129&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797918 / Thu, 02 Jul 2015 00:45:18 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797918 / Thu, 02 Jul 2015 00:45:18 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797940 / Thu, 02 Jul 2015 00:45:40 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797940 / Thu, 02 Jul 2015 00:45:40 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797943 / Thu, 02 Jul 2015 00:45:43 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797943 / Thu, 02 Jul 2015 00:45:43 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797944 / Thu, 02 Jul 2015 00:45:44 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797944 / Thu, 02 Jul 2015 00:45:44 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797946 / Thu, 02 Jul 2015 00:45:46 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797946 / Thu, 02 Jul 2015 00:45:46 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797948 / Thu, 02 Jul 2015 00:45:48 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797948 / Thu, 02 Jul 2015 00:45:48 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797958 / Thu, 02 Jul 2015 00:45:58 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797958 / Thu, 02 Jul 2015 00:45:58 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797964 / Thu, 02 Jul 2015 00:46:04 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797964 / Thu, 02 Jul 2015 00:46:04 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797965 / Thu, 02 Jul 2015 00:46:05 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797965 / Thu, 02 Jul 2015 00:46:05 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797966 / Thu, 02 Jul 2015 00:46:06 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797966 / Thu, 02 Jul 2015 00:46:06 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797968 / Thu, 02 Jul 2015 00:46:08 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797968 / Thu, 02 Jul 2015 00:46:08 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797969 / Thu, 02 Jul 2015 00:46:09 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797969 / Thu, 02 Jul 2015 00:46:09 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797970 / Thu, 02 Jul 2015 00:46:10 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797971 / Thu, 02 Jul 2015 00:46:11 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 1 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797974 / Thu, 02 Jul 2015 00:46:14 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797974 / Thu, 02 Jul 2015 00:46:14 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435797975 / Thu, 02 Jul 2015 00:46:15 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/search/global?searchType' => 'follow',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'search',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'global',
  'type' => '',
  'searchType' => 'follow',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797975 / Thu, 02 Jul 2015 00:46:15 +0000
> URL: /index.php?/REST/search/global?searchType=follow&SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[{"Application":"forums","ContentType":"","TotalResults":0,"Results":[],"Filters":{"Period":[],"Other":[]}}],"Pages":{"TotalItems":0,"TotalPages":0,"CurrentPage":0,"NextPage":0,"PreviousPage":0,"LastPage":0},"PushNotifications":[]}
--------------------------------------------------------------------------------
> Time: 1435797979 / Thu, 02 Jul 2015 00:46:19 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
array (
  '/REST/users/notifications?SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'users',
  'class' => 'notifications',
  'operation' => '',
  'SessionId' => '01f45cd8c64cb8207c3230fb71907d43',
  'sessionId' => '01f45cd8c64cb8207c3230fb71907d43',
)
--------------------------------------------------------------------------------
> Time: 1435797979 / Thu, 02 Jul 2015 00:46:19 +0000
> URL: /index.php?/REST/users/notifications?SessionId=01f45cd8c64cb8207c3230fb71907d43
> User xoxdaniraxox (283785)
Request Time: 0 seconds
{"Success":true,"Data":[],"Pages":null,"PushNotifications":[{"Key":"notifications","Value":0,"Type":"int"},{"Key":"messages","Value":0,"Type":"int"}]}
--------------------------------------------------------------------------------
> Time: 1435874747 / Thu, 02 Jul 2015 22:05:47 +0000
> URL: /index.php?/REST/core/registration/checkEmail?email=Roseanne_87%40msn.com
> User Guest (0)
array (
  '/REST/core/registration/checkEmail?email' => 'Roseanne_87@msn.com',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'registration',
  'operation' => 'checkEmail',
  'email' => 'Roseanne_87%40msn.com',
  'last_visit' => 1435874747,
)
--------------------------------------------------------------------------------
> Time: 1435874747 / Thu, 02 Jul 2015 22:05:47 +0000
> URL: /index.php?/REST/core/registration/checkEmail?email=Roseanne_87%40msn.com
> User Guest (0)
Request Time: 0 seconds
{"Success":false,"Error":{"ErrorCode":"reg_error_email_taken","ErrorMessage":"The email address is already in use","ErrorData":""}}
--------------------------------------------------------------------------------
> Time: 1435874753 / Thu, 02 Jul 2015 22:05:53 +0000
> URL: /index.php?/REST/core/registration/checkUsername?username=Roseanne
> User Guest (0)
array (
  '/REST/core/registration/checkUsername?username' => 'Roseanne',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'registration',
  'operation' => 'checkUsername',
  'username' => 'Roseanne',
  'last_visit' => 1435874753,
)
--------------------------------------------------------------------------------
> Time: 1435874753 / Thu, 02 Jul 2015 22:05:53 +0000
> URL: /index.php?/REST/core/registration/checkUsername?username=Roseanne
> User Guest (0)
Request Time: 0 seconds
{"Success":false,"Error":{"ErrorCode":"reg_error_username_taken","ErrorMessage":"That username is already taken","ErrorData":""}}
--------------------------------------------------------------------------------
> Time: 1435874769 / Thu, 02 Jul 2015 22:06:09 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
array (
  '/REST/core/authenticate' => '',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'authenticate',
  'operation' => '',
  'last_visit' => 1435874769,
)
--------------------------------------------------------------------------------
> Time: 1435874769 / Thu, 02 Jul 2015 22:06:09 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
Request Time: 0 seconds
{"Success":false,"Error":{"ErrorCode":"MISSING_PASSWORD","ErrorMessage":"You must enter a password","ErrorData":""}}
--------------------------------------------------------------------------------
> Time: 1435874775 / Thu, 02 Jul 2015 22:06:15 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
array (
  '/REST/core/authenticate' => '',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'authenticate',
  'operation' => '',
  'last_visit' => 1435874775,
)
--------------------------------------------------------------------------------
> Time: 1435874775 / Thu, 02 Jul 2015 22:06:15 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
Request Time: 0 seconds
{"Success":false,"Error":{"ErrorCode":"MISSING_PASSWORD","ErrorMessage":"You must enter a password","ErrorData":""}}
--------------------------------------------------------------------------------
> Time: 1435874783 / Thu, 02 Jul 2015 22:06:23 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
array (
  '/REST/core/authenticate' => '',
  'module' => 'REST',
  'section' => 'run',
  'request_method' => 'get',
  'app' => 'REST_Service',
  'application' => 'core',
  'class' => 'authenticate',
  'operation' => '',
  'last_visit' => 1435874783,
)
--------------------------------------------------------------------------------
> Time: 1435874783 / Thu, 02 Jul 2015 22:06:23 +0000
> URL: /index.php?/REST/core/authenticate
> User Guest (0)
Request Time: 0 seconds
{"Success":false,"Error":{"ErrorCode":"AUTHENTICATION_ERROR","ErrorMessage":"Invalid username or password","ErrorData":""}}