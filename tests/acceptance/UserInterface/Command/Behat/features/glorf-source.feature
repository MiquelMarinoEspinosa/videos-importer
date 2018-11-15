Feature: Glorf Source Video Importer Feature

  Scenario: Execute command with glorf source
    Given a source
      |     source        |
      |     glorf         |
    When execute the command
    Then should response with message
      """
      imported source: glorf
      imported video: "science experiment goes wrong"; Url: http://glorf.com/videos/3; Tags: microwave,cats,peanutbutter
      imported video: "amazing dog can talk"; Url: http://glorf.com/videos/4; Tags: dog,amazing
      """
