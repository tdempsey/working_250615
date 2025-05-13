from flask import Flask, render_template

# Create an instance of the Flask class
app = Flask(__name__)

# Define a route for the root URL
@app.route('/')
def home():
    return render_template('index.html')

# Define another route that returns a custom message
@app.route('/about')
def about():
    return 'This is the about page!'

# Define a dynamic route that accepts a 'name' parameter
@app.route('/hello/<name>')
def hello(name):
    return f'Hello, {name}!'

# Run the application
if __name__ == '__main__':
    app.run(debug=True)
