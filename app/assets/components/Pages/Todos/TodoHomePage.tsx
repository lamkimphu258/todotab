import React, {useEffect, useState} from "react";
import axios from "axios";
import {useParams} from "react-router-dom";
import TodoList from "./TodoList";
import TodoCreate from "./TodoCreate";

type Todo = {
    name: string,
    slug: string,
    createdAt: DateTimeUTC,
    updatedAt: DateTimeUTC,
}

type DateTimeUTC = {
    date: string,
    timezone: string,
    timezone_type: number,
}

type TodoIndexProps = {
    username: string
}

const compareTodoName = (todo1: Todo, todo2: Todo) => {
    if (todo1.createdAt.date < todo2.createdAt.date) {
        return -1;
    } else if (todo1.createdAt.date > todo2.createdAt.date) {
        return 1;
    }
    return 0;
}

const TodoHomePage: React.FC = () => {
    const [readyState, setReadyState] = useState<boolean>(false);
    const [todos, setTodos] = useState<Todo[]>([]);
    const {username} = useParams<TodoIndexProps>();

    useEffect(() => {
        axios.get(
            `/api/rest/v1/${username}/todos`,
        ).then((response) => {
            setTodos(response.data.sort(compareTodoName));
            setReadyState(true);
        }).catch((error) => {
            console.error(error);
        })
    }, [])

    return (
        <div className={'w-50 mx-auto my-5'}>
            <h1 className={'text-center'}>Todo List</h1>
            <TodoCreate todos={todos} setTodos={setTodos}/>
            <TodoList readyState={readyState} todos={todos}/>
        </div>
    )
}

export default TodoHomePage;