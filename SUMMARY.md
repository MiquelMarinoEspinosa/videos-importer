INSTRUCTIONS TO SET UP ENVIRONMENT
	- install docker (https://www.docker.com/get-started)
	
	- open a terminal
	
	- clone de repository
		$> git clone https://github.com/CMProductions/backend-test.git
	
	- move the video_importer.patch to the backend-test folder
	
	- apply the patch
		$> git am --signoff < video_importer.patch
	
	- create docker image and container
		$> docker-compose up
	
	- open another terminal
	
	- install composer dependencies
		$> docker exec -i -t cm-productions.videos-importer composer install

EXCUTE COMMANDS
	- execute unit tests
		$> docker exec -i -t cm-productions.videos-importer vendor/bin/phpunit --testsuite Unit
	
	- execute unit tests with coverage
		$> docker exec -i -t cm-productions.videos-importer vendor/bin/phpunit --testsuite Unit --coverage-html coverage
		$> open coverage/index.html

	- execute integration tests
		$> docker exec -i -t cm-productions.videos-importer vendor/bin/phpunit --testsuite Integration
	
	- execute all the phpunit tests (unit + integration)
		$> docker exec -i -t cm-productions.videos-importer vendor/bin/phpunit

	- execute acceptance tests
		$> docker exec -i -t cm-productions.videos-importer vendor/bin/behat

	- execute the video importer (samples with some sources)
		$> docker exec -i -t cm-productions.videos-importer bin/console video:importer glorf
		$> docker exec -i -t cm-productions.videos-importer bin/console video:importer flub
		$> docker exec -i -t cm-productions.videos-importer bin/console video:importer glorf flub

TECHNOLOGY USED
	- In order to implements the backend test we used the next technology among other
		- Symfony framework: used to implements the command that execute the video importer functionality. For this it was used the console and the dependency injection components.
		- PHPUnit: The php framework unit test to build the unit and integration tests to test the domain and applications classes.
		- Behat: The BDD acceptance tests framework to test the console that implements the video importer functionality

IMPLEMENTATION
	- The implementation it was made first developing the domain layer using TDD strategy
	- The second step was implement the application layer
	- For this two first steps just PHP and PHPunit was needed to do the implementation and just unit tests was created
	- Next step was implements the infrastructure layer and the creation of integration tests
	- Once this implementation had been done the las step was create the command console in order to implements the video importer functionality
	- The last step was necessary install the symfony framework along with its components and the behat framework to build acceptance tests

DESIGN
	- It was used for the implementation a DDD approach with the layers that are explained bellow:
		- USERINTERFACE
			- The command that implements de video importer functionality it is located in this layer
			- Through dependency injection executes the use case that is gonna do the video import by source
			- This component decides what dependencies are injected to the use case through the symfony service container 
			- The command it is covered by behat acceptance tests

		- APPLICATION
			- In this layer are located the use case that have the mission to execute the domain business logic to do the video import
			- The injection of the components (repository, importer) are interfaces which are implemented in the infrastructure layer
			- The use case returns a DTO (VideoCollectionResource) wich has the information that the command console needs
			- This DTO is build by a DataTransformer that creates a proyection from the domain entities information to the resource DTO
			- The layer is covered by integration (with concrete infrastructure implementation) and unit (with mock objects) tests
		
		- DOMAIN
			- Where the business logic is located
			- The Video entity is the aggregatte root
			- There is two main components besides the aggregatte root:
				- VideoFactoryImporter: Interface that returns a VideoImporter given a source
				- VideoImporter: Interface that given a source import a collection of videos
				- VideoRepository: Interface which persists the video collection
			- All the interfaces are implemented in the infrastructure layer	

		- INFRASTRUCTURE
			- In this layer we have the concrete technoloy implementation of the Domain interfaces
			- Description of technology implementation
				
			IMPORTER
				- SourceVideoFactoryImporter: In function of a source returns a SourceImporter
				- [Glorf|Flub]VideoImporter: Implementation to retrieve the raw information of the source videos
				- Parser: Abstract class used by the video importers using the template method to parse the raw content
				- [Glorf|Flub]Parser: Implementation of a Parser to implements the abstract methods to extract the detailed video information

			REPOSITORY
				- InMemoryVideoRepository: Dummy video repository implementation that is used to implements the backend test
				- MysqlVideoRepository: Not implemented because is was not required for the test
				- CassandraVideoRepository: Not implemented because it was not required for the test 
				
HOW TO
	- CASSANDRA MIGRATION
		- Do the implementation of the CassandraVideoRepository
		- Change config/services.yml file to instance the repository as a service and inject to the use case
		- Bonus (highly recommended): implements an integration tests with the CassandraVideoRepository used by the use case
		- Notice that NO OTHER CLASSES OR TEST MUST BE MODIFIED!
	
	- ADD ANOTHER SOURCE (FTP SOURCE)
		- Create FTPVideoImporter that implement VideoImporter domain interface which is gonna implement how to get the raw content (ftp connection, retrieve file, etc)
		- Create and FTPParser that extends from Parser class and implements the abstract methods in order to extract the video details
		- Add FTP case to the switch in SourceVideoImporter factory to return the FTPVideoImporter
		- Bonus (highly recommended): Implements the integration and acceptance test to cover the ftp source
		- Notice that NO OTHER CLASSES OR TEST MUST BE MODIFIED!

TO DO LIST
	- A lot of exceptions and edge cases was not covered. It is necessary to cover this cases in order to grant the resilience of the application
	- Improve the acceptance test in order to be more robust and do not have butterfly tests
	- Create a git pre-commit hooks to automated check code style and execute the unit tests on each git commit 
