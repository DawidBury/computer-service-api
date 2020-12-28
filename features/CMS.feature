Feature:
    @loginAsUser
    Scenario: Try to create CMS with good credentials
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/cms" with body:
        """
        {
            "attribute": "opening-hours",
            "value": "8:00"
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node attribute should not be null
        And the JSON node value should not be null
