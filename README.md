# any_vote.module

This is an module designed to allow for voting on any content (or any collection of content) on a Drupal site.

It's development is sponsored by level business. At the moment it is in early stages of development and the api could change at any time.

It uses the votingapi for the back end voting system, it also makes use of tokens for variable text.

It is fairly lightweight and will need theming customization to make it look good.

## How to Use any Vote

There is a fairly simple workflow, you can define any vote blocks with hook_any_vote()

These block can then be configured like any other with the block admin system, panels or context.

How to specify an any_vote() block

hook_any_vote() is documented, but here is a little more info on the structure of the vote block definition format

Attributes are:

### Title
This is the title of the block as it would be for any block on the system.
### Info
Is usefull for the block admin system.
### Score type
This is the score type as understood by the voting api currently supported are
 points - where points are averaged for 5 star voting
 option - where a number of options are presented to the user to pick between

 sum is not yet implemented

### Options
is an array of options if the option score type is used. This may have issues with punctuation.

### Empty Text
if no votes have been cast then this text will be displayed in stead of the summary text it can be used to display 'be the first' text. Can use tokens (see below).

### Summary Text
 Used to display a textual summary of the results. can also use tokens.

### Question
The question to pose for voting. For example 'do you like this item?'  

### Id callback
This is very important. It is used as a parameter less function to return an id which can identify what is being voted on.
When called this will return a numeric id for the item you wish to vote on.
(parameters should be implemented at some stage)
At the moment if you use ajax this may cause complications, the path is passed through on ajax. but not the rest of the page context. 

### Token Object Type
This is used by the token module, this allows you to use tokens for a particular type of object as well as the vote specific tokens in your voting text

### Token object callback
If you are using token object type you should use this to determine the object that is passed to the token generations functions along with your type. 
At the moment if you use ajax this may cause complications, the path is passed through on ajax. but not the rest of the page context. 

### link class callback
 A callback to assign classes to the  vote links in the callbacks. 

## In built tokens

These depend on the type of vote being cast but are roughly:

 - [total_count] is the total number of votes cast.
 - [*option*_count] if the type of vote is option, this will be used to indicate how many of a particular vote have been counted. if your options were 'yes' and 'no' you would have tokens [yes_count] and [no_count]
 - [vote_average] is used if the type is score, it is the average vote
 - [vote_sum] if used if the type is score and is the sum of all votes

## Theming any vote
 Any vote blocks use a specialized version of block.tpl.php There are a number of variables passed to make for easier theming. There are also some additional theme suggestions which are added to allow for theming of different types of vote.

 block-any_vote-*VOTE_TYPE*.tpl.php

 will allow for themers to have a different template for each type of vote. Normal suggestions are still applied.

 Classes.

 A few classes are applied to the block to represent the state these are

* widget_has_votes: if there are votes in the widget
* widget_has_no_votes: if there are no votes in the widget
* user_voted: if the user has voted

Additional classes can be added by preprocessor functions by adding to the extra_classes variable.

All normal block classes are still applied.

### Variables
These should be documented in block-any_vote.tpl.php but in outline the $block variable is still used, but with some extra properties these are:

 - text score: a text representation of
   the vote score
 - results: an array of the results
 - content: a standard block attribute and is used for the empty text or summary text
 - question: this is the question that is being asked
 - widget: contains the links which represent the widget.

The items are themed by theme_links there are options to invoke any_vote_options_widget and any_vote_points_widget as theme hooks for a custom implementation.
If a user has voted classes are applied to the items to indicate the users vote.


## TODOs:
* The structure returned for the votes is not very clear and should be reformatted to be as simple as possible.
* Code tidy up and conform to coding standards
* Implement the sum type
* Allow arguments to the callbacks
* Allow a callback for the summary text
* Return path configurable
* Add an option not to use ajax.