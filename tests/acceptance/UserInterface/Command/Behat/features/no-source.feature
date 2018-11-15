Feature: No Source Video Importer Feature

  Scenario: Execute command with no source given
    Given no source
    When execute the command
    Then should response with message
      """
      Please, provide some sources. No sources provided. So no videos has been imported :/
      """
