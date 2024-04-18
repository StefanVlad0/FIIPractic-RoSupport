# FIIPractic-RoSupport

![cloudlab.png](images%2Fcloudlab.png)
![fiiPractic.png](images%2FfiiPractic.png)

Project made by **Stefan Vlad** during the training provided by **CloudLab**, within **fiiPractic**.


##  Contents

1. [About](#about)
2. [Installation](#installation)
3. [Key features](#key-features)


## About

This is the final project for the **"Full-Stack Development by CloudLab"** training.

**RoSupport** is a platform that aims to promote local products.

## Installation
**IMPORTANT!** 

In order for the QR code to be displayed, you need to have [PHP GD](https://www.php.net/manual/en/book.image.php) configured. To achive this:
- Locate and open php.ini.
- Find **;extension=gd**.
- Remove semicolon from **;extension=gd**, save the file and reboot the server.

### Clone the project

```
git clone https://github.com/StefanVlad0/FIIPractic-RoSupport.git
```

Move to the project directory:

```
cd FIIPractic-RoSupport
```

### Install the project's dependencies

```
composer i
```

### Rename .env.example

Rename `.env.example` to `.env` and adjust the port to your needs.

Generate an application encryption key and add it to the .env file:

```
php artisan key:generate
```

### Create database

Create a database in phpmyadmin named `rosupport` and set it's collation to `utf8_general_ci`

### Run migrations:

```
php artisan migrate
```

### Run seeders:

```
php artisan db:seed
```

### Run the server:

```
php artisan serve
```

## Key Features

- [Account management](#account-management)
- [Posts](#posts)
- [Products](#products)
- [Referral](#referral)
- [Promoted Products](#promoted-products)
- [Tags](#tags)
- [Notification System](#notification-system)
- [Language selection](#language-selection)
- [Chat](#chat)

### Account management

Register page:

![Register.png](images%2FRegister.png)

Login page:

![Login.png](images%2FLogin.png)

Once a user has an account, he can change his credentials and he can set a biography and a profile picture on the profile editing page.

![ArrowProfile.png](images%2FArrowProfile.png)

![ArrowEdit.png](images%2FArrowEdit.png)

![EditProfile.png](images%2FEditProfile.png)

### Posts

The platform has 2 main parts: **posts** and **products**.

Users can create posts, which contain a description and a picture.

Posts can receive likes and comments.

![Posts.png](images%2FPosts.png)

### Products

Users can create products, which contain several pictures, a description, quantity, price and tags.

Products can be bought and reviews can be received.

![Products.png](images%2FProducts.png)

![Products2.png](images%2FProducts2.png)

### Referral

Users have a referral link that can be sent to friends.

When someone creates an account with that link, the user will receive 3 points and the person creating the account 1.

![Referral.png](images%2FReferral.png)

### Promoted Products

Points can be used to promote products.

Once a product is promoted, it will be displayed before the others for 24 hours.

![Promoted.png](images%2FPromoted.png)

### Tags

Products can be sorted by tags.

![Tags.png](images%2FTags.png)

### Notification System

Once a product has been purchased, the seller receives a notification about the order.

![Notification.png](images%2FNotification.png)

![Notification2.png](images%2FNotification2.png)

### Language selection

The language can be changed by pressing the flag icon.

![Language.png](images%2FLanguage.png)

### Chat

You can chat with a user by accessing his profile and pressing the "Send Message" button, or, if you have already talked to him, you can do it from the navbar.

![Message.png](images%2FMessage.png)

![Message2.png](images%2FMessage2.png)
