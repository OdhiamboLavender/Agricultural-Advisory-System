// server.js
const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.json());

const registeredUsers = [];

app.post('/signup', (req, res) => {
    const { username, email, password } = req.body;

    if (!username || !email || !password) {
        return res.status(400).json({ error: 'Missing required fields' });
    }

    registeredUsers.push({ username, email, password });

    return res.json({ success: true, message: 'User signed up successfully' });
});

app.listen(port, () => {
    console.log(`Server listening at http://locallhost:${port}`);
});


