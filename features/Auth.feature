Feature:
    Scenario: Call a not found route
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/not-found-route"
        Then the response status code should be 404

    Scenario: Try to register a user with missing "lastName" field
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/users/register" with body:
        """
        {
            "username": "",
            "password": "Testowe123!"
        }
        """
        Then the response status code should be 400
        And the response should be in JSON
        And the JSON node "[username]" should not be null

    Scenario: Successfully register a new user
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/users/register" with body:
        """
        {
            "username": "dawidbury1998@gmail.com",
            "password": "Testowe123!"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node "token" should not be null

    Scenario: Try to login with bad credentials
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/users/login" with body:
        """
        {
            "email": "dawidbury1998@gmail.com",
            "password": "Testowe123!"
        }
        """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node "token" should not be null