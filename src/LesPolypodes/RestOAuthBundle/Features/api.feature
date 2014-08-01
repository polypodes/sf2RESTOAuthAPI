# language: en
Feature: API requests
  In order to share my data
  As a content publisher
  We need to be able to expose an API

  Scenario: books in JSON by default
    Given I go to "/books"
    Then the response status code should be 200
#    And the response should be JSON
#    And the response has a "name" property
#    And the "name" property equals "BehatDemo"

  Scenario: books in JSON using extension
    Given I go to "/books.json"
    Then the response status code should be 200
#    And  the response should be JSON



