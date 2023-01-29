# PCS Group Backend Dev Test

## Database Design

![Database Design](/database_design.png)


## Functional Requirements

- (Auth) User can login with username and password
- (Auth) User is redirected to **products page** after login.
- (Product) User can view products and their prices.
- (Product) User can add product (more than 1 product) to cart.
- (Product) User can check out cart, and is redirected to **summary page**.
- (Summary/Checkout) User can see the products and their prices that the User **added** to cart.
- (Summary/Checkout) User will get 1 coupon for every product in cart that is priced above 50K.
- (Summary/Checkout) User will get 1 coupon for every 100K in total price (all products). E.g, 5 coupons for 550.000, 30 coupons for 3.040.000
- (Summary/Checkout) User cannot checkout if there is no item in cart
- (Summary/Checkout) User is redirected to **history page** after clicking "Confirm" button
- (History) User can view all purchases.
- (History) Purchase status should be **open** if the purchase time was less than 3 hours from now.
- (History) Purchase status should be **closed** if the purchase time was more than 3 hours from now.

## Tech Stack
- Laravel 9 (PHP)
- MySQL
- TailwindCSS

### Requirements
- PHP 8.1
- Composer (2+), latest is preferred.
- MySQL 8.0

## Demo
[Simple Cart Demo Web](https://simple-cart.patricksantino.com).


