### ChitFund Project

### Create a project

* Visit the following URL and download composer to install it on your system.

* https://getcomposer.org/download/

* After the Composer is installed, check the installation by typing the Composer
* composer create-project laravel/laravel –-prefer-dist
##### install the complete framework by typing the following command −

* composer create-project laravel/laravel test dev-develop
##### Start the Laravel service by executing the following command.

* php artisan serve

#### Following are url (postman) of chits table
##### Add new chit (Post)
* http://127.0.0.1:8000/api/NewChit
##### View All Chits (Get)
* http://127.0.0.1:8000/api/Allchits

##### View One chits (Get)
* http://127.0.0.1:8000/api/chit/1
##### Edit (Patch)
* http://127.0.0.1:8000/api/Chit/2?chit_name=lucky_Lakshmi&capital_amount=100000&total_members=20&monthly_payment=5000&duration=20&start_date=2021-01-10&ending_date=2022-08-10

##### Delete chit (Delete)
http://127.0.0.1:8000/api/chit/1


#### Following are url (postman) of Members table
##### Add new Member (Post)
* http://127.0.0.1:8000/api/NewMember

##### View All Members (Get)
* http://127.0.0.1:8000/api/AllMembers

##### View One Member (Get) {pass phone number}

* http://127.0.0.1:8000/api/Member/8898765123

##### Edit Member (Patch) {pass member_id}
* http://127.0.0.1:8000/api/Member/2?

##### Delete Member (Delete){pass member_id}
http://127.0.0.1:8000/api/Member/1
