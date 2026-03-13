# Authentication API Documentation

## Base URL

```
{{Auth}}
```

Example:

```
http://localhost:8000/api
```

This API provides authentication and profile management endpoints including:

- Register
- Login
- Logout
- Get Profile
- Update Profile
- Update Password
- Delete Account

---

# 1. Register

Creates a new user account.

## Endpoint

```
POST {{Auth}}/register
```

## Headers

```
Accept: application/json
```

## Request Body

```json
{
  "name": "Ilyass",
  "email": "ilyass@example.com",
  "password": "ilyass123"
}
```

### Fields

| Field | Type | Description |
|------|------|-------------|
| name | string | User display name |
| email | string | User email |
| password | string | User password |

## Expected Response

```json
{
  "status": "Success",
  "message": "User registered successfully",
  "user": {
    "id": 1,
    "name": "Ilyass",
    "email": "ilyass@example.com"
  }
}
```

---

# 2. Login

Authenticates a user and returns an access token.

## Endpoint

```
POST {{Auth}}/login
```

## Headers

```
Accept: application/json
```

## Request Body

```json
{
  "email": "ilyass@example.com",
  "password": "ilyass123"
}
```

## Successful Response

```json
{
  "status": "Success",
  "message": "Login success",
  "token": "YOUR_ACCESS_TOKEN"
}
```

## Notes

Save the token returned and use it for protected endpoints:

```
Authorization: Bearer {{token}}
```

---

# 3. Logout

Logs out the authenticated user by invalidating the token.

## Endpoint

```
POST {{Auth}}/logout
```

## Authentication

```
Authorization: Bearer {{token}}
```

## Headers

```
Accept: application/json
```

## Request Body

None

## Example Response

```json
{
  "message": "Logout successful"
}
```

## Notes

After logout, protected endpoints will require logging in again.

---

# 4. Get Profile

Fetches the profile information for the currently authenticated user.

## Endpoint

```
GET {{Auth}}/show
```

## Authentication

```
Authorization: Bearer {{token}}
```

## Headers

```
Accept: application/json
```

## Example Response

```json
{
  "status": "Success",
  "message": "Profile fetched successfully",
  "user": {
    "id": 4,
    "name": "Ilyass updated",
    "email": "ilyass@example.comUPd"
  }
}
```

## Common Errors

| Code | Description |
|------|-------------|
| 401 | Unauthorized |
| 403 | Forbidden |

---

# 5. Update Profile

Updates the authenticated user's profile details.

## Endpoint

```
PUT {{Auth}}/update
```

## Authentication

```
Authorization: Bearer {{token}}
```

## Headers

```
Accept: application/json
Content-Type: application/json
```

## Request Body

```json
{
  "name": "Ilyass updated",
  "email": "ilyass@example.comUPd"
}
```

## Example Response

```json
{
  "status": "Success",
  "message": "Profile updated successfully",
  "user": {
    "id": 4,
    "name": "Ilyass updated",
    "email": "ilyass@example.comUPd"
  }
}
```

## Common Errors

| Code | Description |
|------|-------------|
| 401 | Unauthorized |
| 403 | Forbidden |
| 422 | Validation error |

---

# 6. Update Password

Updates the password for the currently authenticated user.

## Endpoint

```
PUT {{Auth}}/updatePassword
```

## Authentication

```
Authorization: Bearer {{token}}
```

## Headers

```
Accept: application/json
Content-Type: application/json
```

## Request Body

```json
{
  "current_password": "ilyass123",
  "new_password": "ilyass12345"
}
```

## Example Response

```json
{
  "status": "Success",
  "message": "Password updated successfully"
}
```

## Common Errors

| Code | Description |
|------|-------------|
| 401 | Unauthorized |
| 403 | Forbidden |
| 422 | Validation error |
| 400 | Incorrect current password |

---

# 7. Delete Account

Deletes the authenticated user's account permanently.

## Endpoint

```
DELETE {{Auth}}/delete
```

## Authentication

```
Authorization: Bearer {{token}}
```

## Headers

```
Accept: application/json
```

## Request Body

None

## Example Response

```json
{
  "message": "Account deleted successfully"
}
```

## Common Errors

| Code | Description |
|------|-------------|
| 401 | Unauthenticated |
| 403 | Forbidden |

---

# Authentication Flow

1. Register a user
2. Login to receive a token
3. Use the token for protected endpoints

Example:

```
Authorization: Bearer {{token}}
```

Protected endpoints:

- Logout
- Get Profile
- Update Profile
- Update Password
- Delete Account