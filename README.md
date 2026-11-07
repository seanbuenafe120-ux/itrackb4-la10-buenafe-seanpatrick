G1
Route model binding needs two things to be true. Name both, and say what happens when only one of them is.
-Route model binding requires the parameter to be type-hinted with the model class and its name to match the route segment exactly[cite: 11]. If only one condition is met, no record is fetched and Laravel fails silently without throwing an error[cite: 11].

G2
Your Delete link opened the detail page instead of deleting anything. Explain why.
-An HTML link can only issue HTTP GET requests, but the delete action requires an HTTP DELETE request method[cite: 14]. Because the movie detail route also listens for GET requests at that same URL path, the browser opened the detail page instead of deleting the record[cite: 14].

G3
old() takes a second argument on your edit form. What would break if you left it out, and what would break if you used only it?
-Leaving out the second argument would cause the edit form fields to open blank because old() would have no database value to fall back on initially[cite: 12, 13]. Using only the record's value without old() would mean that if form validation fails, the inputs would reset to the original database values instead of retaining the user's typed input.