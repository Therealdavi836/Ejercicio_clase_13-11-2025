from locust import HttpUser, task

class MyUser(HttpUser):
    @task
    def get_users(self):
        self.client.get("/api/users")

    @task
    def create_user(self):
        data = {
            "name": "Test User",
            "email": "test_123@gmail.com",
            "password": "password123"
        }
        self.client.post("/api/users", json=data)

    @task
    def update_user(self):

        data = {
            "id": 1,
            "name": "Updated User",
            "email": "updated@example.com",
            "password": "newpassword123"
            }
        self.client.put("/api/users/1", json=data)

    @task
    def delete_user(self):
        self.client.delete("/api/users/1")
