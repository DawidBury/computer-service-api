Feature:
    @loginAsAdmin
    Scenario: Try to create Task with good credentials as Admin
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
        And the JSON node priority value should be 1
        And the JSON node taskType should not be null

    @loginAsAdmin
    Scenario: Try to create Task with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/tasks"
        Then the response status code should be 200
        And the response should be in JSON
