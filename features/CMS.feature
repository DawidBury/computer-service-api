Feature:
    Scenario: Try to create CMS with good credentials
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/users/register" with body:
        """
        {
            "email": "",
            "password": "Testowe123!"
        }
        """
        Then the response status code should be 400
        And the response should be in JSON
        And the JSON node "[username]" should not be null
