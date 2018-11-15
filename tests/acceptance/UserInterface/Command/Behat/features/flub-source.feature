Feature: Flub Source Video Importer Feature

  Scenario: Execute command with flub source given
    Given a source
      |     source        |
      |     flub          |
    When execute the command
    Then should response with message
      """
      imported source: flub
      imported video: "funny cats"; Url: http://glorf.com/videos/asfds.com; Tags: cats, cute, funny
      imported video: "more cats"; Url: http://glorf.com/videos/asdfds.com; Tags: cats, ugly,funny
      imported video: "lots of dogs"; Url: http://glorf.com/videos/asasddfds.com; Tags: dogs, cute, funny
      imported video: "bird dance"; Url: http://glorf.com/videos/q34343.com
      """
