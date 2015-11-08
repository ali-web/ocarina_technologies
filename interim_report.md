#### *ABSTRACT*
Collaborative mechanisms are starting to become prominent in computer games, like massively multiplayer
online games (MMOGs);\cite{CollaborativeGames}

**Keywords**: computer supported collaborative work, collaborative games, game design, word games

##Background and Motivation
* Provide a link to the “original” StoryTime game that we are basing our app on. (Sociables/Kings Cup? Or check out the improv game “one-word-at-a-time”, it’s pretty much the same idea).
* Motivation and relate this to CSCW
* Mention any games that we found that involve a group of people “contributing”.
* Reference papers that discuss research with collaborative games. 
* Reference papers to CSCW in general.
* Refine our research question? (She said it felt a bit too specific). 
* Clearly define who our sample population is for data collection.
* For the phases of research: 
* Give an overview of each phase
* Justify each phase
* Discuss limitations/benefits of the approach
* Give details of each phase 
* Clearly explain the work that we’ve done so far (prototypes, user study, etc.) 
* Don’t mix up survey and interview (they are two different things)! 
* Explain the purpose of doing a second interview.
* Think about whether we need to worry about security.
* Mention how many people we envision playing our game.
* Ensure that our milestones match the descriptions of the work that we’ve been doing.
* Go into more detail for our milestones (it was too high level).

##Introduction

We are taking a game called Story Time and implementing it as a Facebook web application. Story Time is a mini-game, or rule, within the drinking game: Sociables. Which is played by assigning a rule to each value within a deck of cards. The cards are then spread out in a circle and each player takes turns picking a card. Once a card is chosen the rule that is applied to that card must be played out. The Story Time rule is as follows: starting with the player who drew the card, create a story one word at a time. For example, the first player might start the story with “Hello”, and the second player could continue the story with “world”, making the story so far, “Hello world” and so on. An added element to the Story Time rule that we will not be implementing, is the one in which the player must correctly recite the entire story thus far before they can add a word of their own, otherwise they must drink. Currently this game is played in a co-located setting synchronously and we want to change its time-space matrix and make it possible for people to play it remotely and asynchronously with the help of technology.


Need to mention distributed cognition. Peggy mentioned how this is important for this project and it relates to CSCW.
"Developed by Edwin Hutchins, distributed cognition is the theory that knowledge lies not only within the individual but in the individual's social and physical environment."
The dependence of the theory on the social and physical environment of the individual makes it very useful in analyzing human-computer interactions and educational technologies.

##Background
The StoryTime game being implemented as described by this paper is based on a modified version of a game often played in social friend groups, named "One Word At A Time" \cite{dramaresource, izzyg}. The game "One Word At A Time" is often played with 5 to 10 players as part as a improv exercise, and is also called "Word At a Time", "Sentence At a Time", or "Word At a Time Expert" \cite{learnimprov}.  Variations of the game support non-linear turn orders, changed player counts and full sentence at a time additions to the story. Sometimes the participants in this game, often called players, will act out the story as it is created. This often requires large coordination and non-verbal communication skills as part of the player group partaking the game.

While the games main focus is the ability to improv group coordination across the players participating, games played at a professional level, with an often modified game rules can lend itself to audience entertainment. It has been shown to be popular forms of entertainment for non-participants to spectate, as seen on the TV show "Whose Line is it Anyway?", with games such as "Questions Only?" and "Questionable Impressions." \cite{whoseline}. The end result of either the professional spin-offs or amateur version often lead to stories with comedic results.

Attempts at translating the "One Word At A Time" game to the digital space have created subpar solutions in the past. One solution created by would be players was to create a One Word At a Time subreddit, equivalent to a internet bulletin board or form on the site reddit.com, to recreate the game \cite{reddit}. This internet space has become unused after just 5 sessions of the game, due to the changes space in which the game resides in the time/space matrix first described by johansen created by the digital translation \cite{cscw-matrix}. That is, a change from "same place same time" to "different place different time". Other attempts by players, such as the Clash of Clans wikia forums have resulted in similar failures \cite{coc-wikia}.

One unique property of the "One Word At A Time" game that makes it difficult to translate is that there is no win or lose condition enforced upon the players, and instead the ability to maintain the spotinaity and flow of the story becomes the goal of the exercise \cite{improv.ca}. This means that there is no predefined end point or goal for which the game is caused to finish, unlike most games \cite{learn-canvas, badge-ville, makeschool}.

*TODO for Background / Related Work*:
 - Add Related work
 - - Note: nextsentence.ca is ghost town (no stories created in past week).
 - - Need to find issues that caused that
 - - Games from proposal slides
 - Reorder paragraphs in background
 - get additional + more reliable sources
 - Get other digital attempts by players (CoC / /r/owaat).

##Minimum  Viable Product
Since StoryTime is a project that is focused more on implementation rather than research, our team will be creating a Minimal Viable Product (MVP) in order to conduct further user testing. The MVP will take into consideration the information we gathered and analyzed from our first user testing on the prototypes discussed above. In order to assist in building the MVP, we have created a conceptual design and will use this to conduct a cognitive walkthroughs with each member in our team. This will allow us to easily realize any missing components in our game prior to the MVP implementation.

The MVP will be implemented as a web application, which when finalized, we intend to release as a Facebook game application. The purpose of the MVP is to decide on the features we have discussed for StoryTime and to determine whether they will be implemented into the final product. The MVP will be designed in a way that allow players to be distributed on their own computers while playing the game. This will allow for a more realistic approach in the user testing, in comparison to the first prototype, which forced the players to pass around a single computer. It is important to note, however, that the implementation of our final product is not in the scope of this project. We will instead discuss what we found from our user testing of the MVP and provide thorough documentation on what we believe the final product will consist of and why.

##Technical Tools
The conceptual design was planned out using an online, collaborative, diagramming tool called LucidChart. This tool makes it easy to create and share flowcharts, mockups, UML (Unified Modeling Language), mind maps and more.

Although we stated above that the MVP will be implemented after the conceptual design, our team has built the necessary platform in order to start the implementation process. The following are the tools we are using that allow us to collaborate on coding this application:
<ol>cPanel and phpMyAdmin to support the database that stores players stories and information</ol>
<ol>GitHub allowing for version control and collaboration</ol>
<ol>PhpStorm by Jetbrains as our coding environment</ol>

###Findings
our fidnings in this work

###Discussion
Discuss about findings

###Limitations
limitations in our research and design that we couldn't address properly and affected our results

###Future Work
What could be done in future to improve this work

###Conclusion
Final words

####Acknowledgement
We are extremely grateful to all the interview and survey participants who accompanied us in several steps and we special thanks for our insturctor and teaching assistant who seriously helped us in this work to be accompolished.

##References

CollaborativeGames = Zagal, José P., Jochen Rick, and Idris Hsi. "Collaborative games: Lessons learned from board games." Simulation & Gaming 37, no. 1 (2006): 24-40.

dramaresource = http://dramaresource.com/drama-games/storytelling/one-word-at-a-time/ Accessed: Nov 8

izzyg = http://www.izzyg.com/images/file/playingalong-oneword.pdf Accessed: Nov 8

learnimprov = http://learnimprov.com/?p=328 Accessed: Nov 8

imporv.ca = http://improv.ca/word-at-a-time-the-practice-game/ Accessed: Nov 8

whoseline = http://www.whoseline.net/show/games.html Accessed: Nov 8

reddit = https://www.reddit.com/r/owaat Accessed: Nov 8

cscw-matrix = http://www.enolagaia.com/UMUArchive/CSCW.html Accessed: Nov 8

learn-canvas = https://learn.canvas.net/courses/3/pages/level-3-dot-1-2-objectives-goals Accessed: Nov 8

badge-ville = https://badgeville.com/wiki/Game_Design Accessed: Nov 8

makeschool = https://www.makeschool.com/gamernews/298/5-basic-elements-of-game-design Accessed: Nov 8

Motivation for our game: http://dramaresource.com/drama-games/storytelling/one-word-at-a-time/

A forum with people playing this game in a similar way. Next person has to have one word more than the previous persons': http://clashofclans.wikia.com/wiki/Thread:264026

Next Sentence: https://nextsentence.ca/

Prototyping tool: https://proto.io/




##Progress so far/Milestones met: *appendix 

**Written proposal (Oct.16):** Completed written proposal that describes what our project is about and the work that we will be doing this term. 

**Ethics application (Oct.19):** Ethics application and consent forms created in order to conduct interviews and user testing. 

**Finish prototype (Oct.23):** Finished creating two prototype versions of our game that will be tested by users. 

**Run user testing sessions (Oct. 26 & Oct.29):** Conducted two user testing sessions that involved participants playing with the prototypes. Interviewed participants to receive feedback and 

**Analyzing data from user testing (Oct.27):** Transcribed the recorded interviews to analyze the data. Determined from the data which prototype version of the game and features the participants liked. 

**Finalize project requirements (Oct.30):** Discussed as a group what our project’s final requirements are and how we will be moving forward. 

**Conceptual design (Nov.3):** Conceptual design completed in order to assist in the creation of our MVP. 

##Milestones *appendix

**Interim project report (Nov.13):** Complete interim report which describes our current work and the progress of the project. 

**Finalize MVP implementation (Nov.18):** The creation of a web application of the game will be completed.

**Cognitive walkthrough of MVP implementation (Nov.19):** Each member of our team will conduct a cognitive walkthrough of the MVP to identify any usability issues. 

**Fix problems found after cognitive walkthrough (Nov.20):** Using the data collected from the cognitive walkthrough, we will improve and fix any problems of our MVP. 

**User testing (cooperative observation) of MVP followed by interviews (Nov.26):** Conduct our second round of user testing where participants will play the game using the MVP and be interviewed after.

**Analyze and interpret interviews (Nov.27):** Using the data collected from the interviews, we will analyze and determine what the final product would have been like if we were doing the full implementation. 

**Final presentation (Dec.2):** Present to the class the work that we have completed. 

**Final report (Dec.5):** Final report describing in detail the work that we have done. 
