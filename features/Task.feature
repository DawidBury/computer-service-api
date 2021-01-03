Feature:
    @loginAsAdmin
    Scenario: Try to create TaskType with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/tasks" with body:
        """
        {
            "priority": 1,
            "taskTypeId": 1
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
