Feature:
    @loginAsAdmin
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
        And the JSON node active value should be false

    @loginAsAdmin
    Scenario: Try to get CMS
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/cms"
        Then the response status code should be 200
        And the response should be in JSON

    @loginAsAdmin
    Scenario: Try to create CMS with good credentials
        When I add "Content-Type" header equal to "application/json"
        And I send a "PUT" request to "/api/cms" with body:
        """
        {
            "id": 1,
            "attribute": "opening-hours",
            "value": "8:00",
            "active": true
        }
        """
        Then the response status code should be 200
        And the response should be in JSON
        And the JSON node attribute value should be "opening-hours"
        And the JSON node value value should be "8:00"
        And the JSON node active value should be true
