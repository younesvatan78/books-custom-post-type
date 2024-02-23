# WordPress Books Management Plugin

This WordPress plugin is designed to enhance content management capabilities by introducing a custom post type for books. 
## Features

- **Custom Post Type for Books**: Registers a custom post type, `Books`.
- **Custom REST API Endpoint**: Offers a custom REST API endpoint to edit book details (title and description) publicly accessible without authentication.

## Installation

1. **Download the Plugin**: Download the ZIP file of this plugin from GitHub.
2. **Upload and Activate in WordPress**:
   - Navigate to your WordPress admin dashboard.
   - Go to `Plugins` > `Add New` > `Upload Plugin`.
   - Choose the downloaded ZIP file and click `Install Now`.
   - After installation, activate the plugin by clicking on `Activate Plugin`.
3. **Verify Installation**: Once activated, `Books` should appear in your WordPress admin menu, indicating the custom post type was successfully registered.

## Usage

### Adding and Managing Books

- **Add New Book**: Navigate to `Books` in the WordPress admin menu and click `Add New` to create a new book entry.
- **Edit Book**: Click on an existing book from the list to modify its details.

### Editing Books via Custom REST API Endpoint

To edit a book's title and description, send a POST request to `/wp-json/custom-book/v1/update-book/{id}`, replacing `{id}` with the ID of the book you wish to update.

**Example Request**:

```bash
curl --request POST \
  --url http://yourwebsite.com/wp-json/custom-book/v1/update-book/123 \
  --header 'Content-Type: application/json' \
  --data '{"title":"New Book Title", "description":"New book description.", "author":"Author Name", "price":"19.99", "year":"2021"}'

