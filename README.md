# IPRA Task Management

IPRA Task Management is a lightweight task tracking application inspired by Jira, designed to help teams manage their tasks and bugs efficiently. The application allows users to create, update, and track tasks and bugs, along with adding comments and changing their status.
## Screenshots

![Screenshot 1](https://i.ibb.co/vPq8vt8/ipra5.png)

![Screenshot 2](https://i.ibb.co/b1pgM7z/ipra2.png)

![Screenshot 3](https://i.ibb.co/N3HSXT0/ipra3.png)

![Screenshot 4](https://i.ibb.co/F6mpZDQ/ipra1.png)

![Screenshot 5](https://i.ibb.co/CV6MZy7/ipra4.png)
## Features

- **Task and Bug Entities**: Define tasks and bugs with common attributes like title, description, creator, tester, assignee, and status.
- **Persistent Data Storage**: Data in the database is never deleted, only created or updated, ensuring data integrity and history tracking.
- **Shared Methods**: Common methods like "change status" and "add comment" are available for both tasks and bugs.
- **Entity Type Modification**: Ability to change the type of entity from task to bug or vice versa.
- **Standard Fields**: Mandatory fields for entities include title, description, creator, tester, assignee, and status.
- **Available Statuses**: Supported statuses include "paused," "in progress," "testing," and "released."
- **Data Manipulation**: CRUD operations are implemented for both entities and comments.
- **Change Logging**: All data modifications are logged in a separate database table for auditing purposes.
- **Commenting System**: Users can add comments to entities, with support for replying to existing comments.
- **CRUD API**: Provides endpoints for creating, reading, updating, and deleting entities and their comments.

## Technologies Used

- **Backend**: PHP's Laravel
- **Frontend**: Vue.JS
- **Database**: MySQL

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP version >= 8.2
- Laravel 11.0
- Composer installed
- Node.js and npm (for frontend dependencies)

## Installation

To install IPRA Task Management, follow these steps:

1. Clone the repository: `git clone https://github.com/your-username/IPRA-Task-Management.git`
2. Install PHP dependencies: `composer install`
3. Install frontend dependencies: npm install
4. Set up your environment variables: `cp .env.example .env`
5. Generate application key: `php artisan key:generate`
6. Migrate the database: `php artisan migrate`
7. Start to seed the database with example data: `php db:seed`

## Usage

To use IPRA Task Management, follow these steps:

1. Run the application: `php artisan serve`
2. Access the application in your web browser at `http://localhost:8000`

## License

This project is licensed under the MIT License.

