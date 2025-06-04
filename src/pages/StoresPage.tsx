import { useState } from "react";
import "../App.css";

function StoresPage() {
  const [count, setCount] = useState(0);

  return (
    <div className="flex flex-col items-center justify-center h-screen bg-slate-800 text-white">
      <h1 className="text-4xl font-bold mb-6">Stores Page</h1>
      <div className="card mb-6">
        <p className="mb-4">This is the stores page of our multipage application.</p>
        <p className="mb-4">You can easily integrate these files into your WordPress site.</p>
        <button onClick={() => setCount((count) => count + 1)} className="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition-colors">
          Count is {count}
        </button>
      </div>
      <div className="mt-6">
        <a href="quiz.html" className="text-blue-400 hover:text-blue-300 underline mr-4">
          Go to Quiz Page
        </a>
      </div>
    </div>
  );
}

export default StoresPage;
