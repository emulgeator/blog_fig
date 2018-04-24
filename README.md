### What is this repository for? ###

A project which contains a single application to render a simple blog with one owner only.

### How do I get set up? ###

## Docker ##
The development environment can be found as Docker containers. 
Just call in the root  directory of the project: **docker-compose up -d --build**

## Environment ##
I left my own development .env file committed in the repository.
It can be used as it is. Of course you are free to edit it if you need to.
Don't forget to add your application host to your hosts files!

### How it works ###
There are a few pages implemented:
* A main page where the blog posts are listed
* A blog post page where the actual post can be seen.

Both of the pages look different if you are signed in, in that case you can reach the editor functions.
You can create, update or delete the posts. Publish or un-publish them.


