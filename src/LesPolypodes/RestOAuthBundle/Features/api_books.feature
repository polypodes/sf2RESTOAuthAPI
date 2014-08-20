# language: en
Feature: Book-related API requests
  In order to share my books data
  As a content publisher
  We need to be able to expose an API with books
  In a HATEOAS way.


###################################################
#
# JSON

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

  Scenario: book #1 in JSON by default
    Given I go to "/books/1"
    Then the response status code should be 200
#    And the response should be JSON
#    And the response has a "name" property
#    And the "name" property equals "BehatDemo"

  Scenario: books in JSON using extension
    Given I go to "/books/1.json"
    Then the response status code should be 200
#    And  the response should be JSON

###################################################
#
# XML

  Scenario: books in XML using extension
    Given I go to "/books.xml"
    Then the response status code should be 200
#    And the response should be JSON
#    And the response has a "name" property
#    And the "name" property equals "BehatDemo"

  Scenario: book #1 in XML using extension
    Given I go to "/books/1.xml"
    Then the response status code should be 200
#    And  the response should be JSON


###################################################
#
# HTML

  Scenario: books in HTML using extension
    Given I go to "/books.html"
    Then the response status code should be 200
#    And the response should be JSON
#    And the response has a "name" property
#    And the "name" property equals "BehatDemo"

  Scenario: book #1 in HTML using extension
    Given I go to "/books/1.html"
    Then the response status code should be 200
#    And  the response should be JSON



