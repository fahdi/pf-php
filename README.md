#Trip sorter

	Guide time allowed: 2 hours Task

You are given a stack of boarding cards for various transportations that will take you from a point A to point B via several stops on the way. All of the boarding cards are out of order and you don't know where your journey starts, nor where it ends. Each boarding card contains information about seat assignment, and means of transportation (such as flight number, bus number etc).

Write an API that lets you sort this kind of list and present back a description of how to complete your journey.

For instance the API should be able to take an unordered set of boarding cards, provided in a format defined by you, and produce this list:

1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
5. You have arrived at your final destination.
The list should be defined in a format that's compatible with the input format. The API is to be an internal PHP API so it will only communicate with other parts of a PHP application, not server to server, nor server to client. Use PHP-doc to document the input and output your API accepts / returns.

# Requirements

No 3rd party frameworks are allowed apart from for testing. Start all code from scratch.

1. Provide a README file containing clear, simple instructions upon how to execute the code and tests.
2. If anything needs clarification which is not detailed here, make an assumption and note this in the README file.
3. Be prepared to suggest to us how we could extend the code towards new types of transportation, which might have different characteristics.
4. The implementation of your sorting algorithm should work with any set of boarding passes, as long as there is always an unbroken chain between all the legs of the trip. i.e. it's one continuous trip with no interruptions.
5. The algorithm doesn't need to consider that departure / arrival are in the correct order. In fact there is no information about any such times on the boarding passes. It is just assumed that your next connection is waiting for you when you arrive at a destination.
6. The algorithm should have the lowest possible order of complexity (Big O notation) you could think of.

#What we look at

This task is designed to give us an idea of:

- how you structure your code.
- your understanding of OO.
- your understanding of TDD.
- your ability to deliver an appropriate, simple solution to a given problem
- how you work when faced with limited time to solve a problem of significant
complexity.
- the efficiency of the sorting algorithm you implement.

Hint: we are not looking for a solution designed to demonstrate your entire knowledge of PHP. Please just make appropriate use of the language to solve the problem in hand cleanly.


##PF PHP test development info

	Start time: 4:00 PM UAE time

# Dev Stack Used

MAMP Pro with PHP 5.5.10
Sublime Edit 3
PhpStorm 7.1
Terminal for php cli (Used html based output so CLI won't be clean and practically useless in test)


# Underatanding/ Methodology

- Regular OOP based PHP is used for creating the API. 
- I have kept the testing simple. 
- The boarding passes/cards have this follwing common info so a genric pass consists of:
	- Departure Location
	- Arrival Location
	- Seat #
- A train, plane, airport, aiport bus or any other terminal boarding passes have additional info that is the repective train #, flight #, bus #, terminal #, Gate # etc. This means is one super object for the boarding pass and for the bus, plane, train, airport bus etc, there is additional info with the respetive detail.
- Since there is extra info pertaining to each class, on top of a boarding pass class, this enables me to make a base class and use DRY principle to inherit other kinds of passes from it.
- After creating the respective classes, each class can be used to create a boparding bass of certain type all inheriting from the base class.
- Another class is TripSorter which gets an object consisting of multiple objects with each being from one type of boarding pass objects (Train, Flight, Airport etc). So it takes these are sorts them.
- A trip class consists of n number of boarding passes of various types. It creates a TripSorter object and then uses a sorting method from TripSorter to get the same object with sorted boarding passes.


# Example Usage

	<?php
	include_once('api.php');

	  // Lets plan a trip

	  $myTrip = new Trip([
	   
	    new AirportBusBoardingPass('Barcelona', 'Gerona Airport'),    
	    new FlightBoardingPass('Stockholm', 'New York JFK', '7B', 'SK22', '22'),
	    new TrainBoardingPass('Madrid', 'Barcelona', '45B', '78A'),
	    new FlightBoardingPass('Gerona Airport', 'Stockholm', '3A', 'SK455', '45B', '344')
	  ]);

	echo $myTrip->TripString();

	?>

It should output sorted list. There is test code in test.php which tests it with different order. 	

# I admit

- Having worked extensively on CMS systems hasn't helped my OOP skills and rusted my skills. Damn you wordpress!
- Had too much distraction due to construction work I am managing at home. Thats why my time.log is so funny :)
- My focus had been more on the ' ability to deliver an appropriate, simple solution to a given problem' than actually working on organizing the code 
- I am a lazy programmer still learning to do proper TDD. My tests are only useful to me. I should spend one complete month with PHP Unit alone.
- There are three steps in the sorting alo each of Oh(n) = 3n. I believe it can be improved but I admit I couldn't think of that right now.
- After finishing this project, I searched github for similar solutions and landed here https://github.com/irfan/tripsorter. I am really impressed by how irfan has done it. That is essentially the way it should be done and I will go through that project to learn from him. And if I get hired after this test, I'd have a lot to learn from all people at the company specially Irfan. 
- I want to delete all my code after having a look at https://github.com/irfan/tripsorter
