# language: en
Feature: API requests
In order to share my data
As a content publisher
We need to be able to expose an API

  Scenario: Exposing Books informations

    Given I prepare a GET request on "/books"
    When I send the request
    Then I should receive a 200 json response

  Scenario: Exposing API informations

    Given I prepare a GET request on "/"
    When I send the request
    Then I should receive a 200 response

