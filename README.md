anime
=====

Anime is a style of Japanese animation which first appeared in the early 1900s and gained popularity in the 1970s.  Today, it is widely popular in Japan and has a sizeable fan base throughout the world.  “Anime” refers specifically to the style of animation, and encompasses a wide range of genres, themes, plots, etc.  Animes come in two main varieties:  series and movies.  A series is a set of contiguous episodes which are connected by an overarching plot line.  A movie is a self-contained, stand alone work.


The website contains a database containing information about each Japanese anime.  For each anime, we will have detailed information regarding its title - both official and alternate - its original air date, current status, the characters contained within it, the voice actors who voice each character, and the production company and animators responsible for the anime.  Additionally, the most popular animes may spawn sequels; in this case, we will also store information regarding the relationship between different animes (i.e. prequel, sequel, etc.).


For individuals who are interested in anime, we will also design a website where users can access this data.  Each user will be able to search for specific anime, keep a “favorites” list of anime, receive suggestions based on their favorites, rate and review animes according to their preference, and join fan groups for and leave comments on individual animes.


Users will be able to be given various access rights.  Standard users will only be able to search the database for information about their favorite anime.  Moderators will be users who are in charge of fan pages or comment threads for certain animes.  They will have additional privileges, such as the ability to delete or edit comments, restrict a user’s ability to comment, or even ban users, temporarily or permanently.  Finally, administrators will have the most privileges.  They will actually be able to update and modify the database.


A special note should be made regarding searches.  We intend to implement a search feature that returns results based not only on the terms entered, but is specifically tailored to each user based on his previously selected favorite animes.  In general, two different users who input the same search term should not necessarily expect to receive identical results.


Data Descriptions/Entity Classes:

User - A user is simply a person who uses the website.  Users come in 2 categories.  Standard users can view information, as detailed above.  Administrators have all the rights as standard users, but can also update, delete, or modify the database.  Users can join fan clubs and rate and comment on various animes.

Anime - An anime is a single Japanese cartoon.  An anime is either a series or a movie, and contains many characters.  It may be the prequel or sequel of another anime and may be commented on by many users.  Animes can have many reviews and comments associated with them.

Character - One of the characters of an anime.  Characters belong to (potentially) many anime, and are voiced by potentially several voice actors.

Voice Actor - A voice actor provides the voice for a character.  A voice actor can voice several characters and can do work for several animes.

Production Company - A production company is responsible for actually creating an anime.  A production company can produce many animes.

Comment - A comment is a user’s comment on a particular anime.  A user may make many comments on many anime.
