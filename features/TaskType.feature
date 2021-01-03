Feature:
    @loginAsAdmin
    Scenario: Try to create TaskType with good credentials as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/task-types" with body:
        """
        {
            "name": "Wymiana pasty termoprzewodzącej",
            "cost": 50
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node name value should be "Wymiana pasty termoprzewodzącej"
        And the JSON node cost value should be 50

    @loginAsAdmin
    Scenario: Try to get list of TaskType as Admin
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/task-types"
        Then the response status code should be 200
        And the response should be in JSON
        And dump the response

    @loginAsUser
    Scenario: Try to create TaskType with good credentials as User
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/task-types" with body:
        """
        {
            "name": "Wymiana pasty termoprzewodzącej",
            "cost": 50
        }
        """
        Then the response status code should be 403