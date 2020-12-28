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
            "email": "",
            "password": "qwerty123!"
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
            "email": "example@user123.pl",
            "password": "qwerty123!"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node "token" should not be null

    Scenario: Try to get users from system as common user
        Given user with this "example@user123.pl" has "ROLE_USER"
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/users"
        Then the response status code should be 401