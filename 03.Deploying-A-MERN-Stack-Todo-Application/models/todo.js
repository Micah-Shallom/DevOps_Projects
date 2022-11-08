const mongoose = require('mongoose');
const { Schema } = mongoose;


const TodoSchema = new Schema({
    action: {
        type: String, 
        required: [true, 'The todo text field is required']
    }
})


const Todo = mongoose.model('Todo', TodoSchema)
module.exports = Todo;