Feature: No Exists Source Video Importer Feature

  Scenario: Execute command with no exists source given
    Given a source
      |     source        |
      |   some_source     |
    When execute the command
    Then should response with message
      """
      Oooops! some error happened :/:
      The source name does not exist: some_source
      Existing sources are: glorf,flub
      """
