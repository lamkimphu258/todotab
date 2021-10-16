import React, {useEffect, useState} from "react";
import axios from "axios";
import TodoList from "./TodoList";
import TodoCreate from "./TodoCreate";
import useToken from "../../CustomHooks/useToken";

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
    const [token] = useToken();

    const config = {
        headers: {Authorization: `Bearer ${token}`}
    };

    useEffect(() => {
        axios.get(
            `/api/rest/v1/todos`,
            config,
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
            <TodoList readyState={readyState} todos={todos} setTodos={setTodos}/>
        </div>
    )
}

export default TodoHomePage;
