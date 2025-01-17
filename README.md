# VPN Admin Panel with Referral System

This project is a comprehensive VPN Admin Panel designed for managing VPN servers, users, and referrals, developed by **Sameed**. The admin panel allows for full control over VPN services, user subscriptions, and a powerful referral management system to encourage user growth.

## Project Overview
The VPN Admin Panel offers a central hub for VPN service providers to manage their servers, users, subscriptions, and referrals. With advanced features like referral tracking and rewards, this panel is ideal for managing and scaling your VPN business.

## Features
- **Server Management**: Add, update, or remove VPN servers and monitor their statuses.
- **User Management**: Track user activity, handle subscriptions, and manage device limits.
- **Subscription Plans**: Create and manage different subscription plans, including trials and paid plans.
- **Referral System**: 
  - Track user referrals.
  - Manage referral rewards.
  - Set referral limits for each plan.
- **Analytics & Reporting**: View detailed reports on user activity, subscriptions, and referral performance.
- **Device Limit Control**: Manage device restrictions per user and per subscription plan.
- **Monetization**: Handle subscription payments and promo codes.

## Requirements

- PHP 8.x or later
- Composer
- Laravel 11.x or later
- MySQL or any other supported database

## Installation
1. **Clone the repository**:
    ```bash
    git clone https://github.com/sameededitz/aj-vpn.git
    ```
2. **Navigate to the project directory**:
    ```bash
    cd aj-vpn
    ```
3. **Install dependencies**:
    ```bash
    composer install
    ```
4. **Set up environment variables**:
    ```bash
    cp .env.example .env
    Configure the `.env` file with your database

    php artisan key:generate
    ```
5. **Run migrations**:
    ```bash
    php artisan migrate
    ```
6. **Start the development server**:
    ```bash
    php artisan serve
    ```

## Usage
- **Admin Login**: Access the admin panel using the provided URL and your admin credentials.
- **Dashboard**: Get an overview of VPN server statuses, active users, and referral statistics.
- **Server Management**: Add and configure VPN servers for user access.
- **Referral Management**: Track referrals, view referred users, and manage rewards.
- **Subscription Management**: Set up and edit subscription plans with device limits and referral bonuses.
- **Analytics**: Use the reports section to analyze user activity, subscriptions, and referral trends.

## Referral System
- **User Referrals**: Each user has a unique referral code to invite others.
- **Referral Tracking**: Easily track how many users a particular user has referred.

## Developer Information
- **Developer**: Sameed
- **Instagram**: [@not_sameed52](https://www.instagram.com/not_sameed52/)
- **Discord**: sameededitz
- **Linktree**: [linktr.ee/sameededitz](https://linktr.ee/sameededitz)
- **Company**: TecClubb
  - **Website**: [https://tecclubb.com/](https://tecclubb.com/)
  - **Contact**: tecclubb@gmail.com

## Contributing
Contributions are welcome! Feel free to fork the repository and submit a pull request. For major changes, please open an issue to discuss your ideas first.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact
For inquiries or support, reach out to us at:
- **Email**: tecclubb@gmail.com
