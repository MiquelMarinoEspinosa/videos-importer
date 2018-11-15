Feature: All Sources Video Importer Feature

  Scenario: Execute command with all existing sources
    Given a source
      |     source        |
      |     glorf         |
      |     flub          |
    When execute the command
    Then should response with message
      """
      imported source: glorf
      imported video: "science experiment goes wrong"; Url: http://glorf.com/videos/3; Tags: microwave,cats,peanutbutter
      imported video: "amazing dog can talk"; Url: http://glorf.com/videos/4; Tags: dog,amazing

      imported source: flub
      imported video: "funny cats"; Url: http://glorf.com/videos/asfds.com; Tags: cats, cute, funny
      imported video: "more cats"; Url: http://glorf.com/videos/asdfds.com; Tags: cats, ugly,funny
      imported video: "lots of dogs"; Url: http://glorf.com/videos/asasddfds.com; Tags: dogs, cute, funny
      imported video: "bird dance"; Url: http://glorf.com/videos/q34343.com
      """
