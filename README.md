# Primary Category Plugin
WordPress plugin allows users to set a primary category for a post. 
Posts can be queried by primary category because it uses custom post meta to store the value.

# Improvements
- Write in ES6
--Using jQuery because it is already installed by default as a dependency, but if we wanted to remove jQuery, plugin obviously wouldn't work.
- Use an API to generate suggested category names or tags based off of primary category. For example: If the primary category is Books, related categories could be Science Fiction, Crime, Romance, etc.
