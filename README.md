<img src="https://media.giphy.com/media/tJMVcTfzDdL1pOGxlk/giphy.gif" width="100%">

# Wunderlist

My Wunderlist application where you can create to-do lists and tasks. You can also see it [here](http://sofiaronnkvist.com/).

# Installation

Clone the repo to your own computer and fire up a local server.

# Code Review

Code review written by [Emma Hansson](https://github.com/h-emma).

1. The index.php file is a bit difficult to navigate. An option could have been to split it up or add comments for what each part does.
2. You can help the user to do right from the beginning by adding a text in register.php line 33. You could write that the password needs to be a minimum of at least 16 characters. 
3. In footer.php there are three links. To get good semantics in the HTML these would be placed in a ul and li.
4. In index.php lines 39, 96 and 208 there are labels missing on input for the checkbox. Using labels makes it more accessible.
5. In index.php there are class names that refer to Bootstrap but that are not used. Maybe replace these classes with something that is more explanatory of what the div contains, for example "form".
6. Clear in the styling folder about where I should lead to finding styling for the different pages of the website.
7. In app.css there is left-out code that is not used, it is good to remove such when the project is finished.
8. In app.js there are a lot of functions for toggling between showing different things such as forms and not showing them. To make it clearer what these functions do, you could name it with toggle eg toggleEditTaskListButton.
9. In function.php you have declared which data type is generated but it is missing which data types the function consists of, eg 
$taskId is an int
10. There are two database files but only one is used, could have been good if the unused data was deleted.

# Testers

Tested by the following people:

1. [Nema Vinkeloe Uuskyla](https://github.com/patrosk)
2. [Amanda Hultén](https://github.com/amandahulten)
