# Personal Notes API

Este proyecto es una aplicación en Laravel para gestionar notas personales mediante una API RESTful. Permite crear, leer, actualizar y eliminar notas.

## Instrucciones de Instalación

1. Clone the repository:
```bash
git clone https://github.com/yourusername/personal-notes-api.git
cd personal-notes-api
```
2. Install dependencies:
```bash
composer install
```
3. Set up environment variables:
Create a `.env` file in the root directory and add:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
4. Run the migrations:
```bash
php artisan migrate
```
5. Start the server:
```bash
php artisan serve
```
The server will run at: `http://localhost:8000`
## API Endpoints
- **POST /api/notes**: Create a new note.
- **GET /api/notes**: Retrieve all notes.
- **GET /api/notes/{id}**: Retrieve a specific note by ID.
- **PUT /api/notes/{id}**: Update a note by ID.
- **DELETE /api/notes/{id}**: Delete a note by ID.