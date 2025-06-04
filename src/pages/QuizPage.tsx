import { useState } from "react";
import "../App.css";

function QuizPage() {
  const [currentQuestion, setCurrentQuestion] = useState(0);
  const [score, setScore] = useState(0);
  const [showScore, setShowScore] = useState(false);

  const questions = [
    {
      questionText: 'What is the capital of France?',
      answerOptions: [
        { answerText: 'New York', isCorrect: false },
        { answerText: 'London', isCorrect: false },
        { answerText: 'Paris', isCorrect: true },
        { answerText: 'Dublin', isCorrect: false },
      ],
    },
    {
      questionText: 'Who is CEO of Tesla?',
      answerOptions: [
        { answerText: 'Jeff Bezos', isCorrect: false },
        { answerText: 'Elon Musk', isCorrect: true },
        { answerText: 'Bill Gates', isCorrect: false },
        { answerText: 'Tony Stark', isCorrect: false },
      ],
    },
    {
      questionText: 'The iPhone was created by which company?',
      answerOptions: [
        { answerText: 'Apple', isCorrect: true },
        { answerText: 'Intel', isCorrect: false },
        { answerText: 'Amazon', isCorrect: false },
        { answerText: 'Microsoft', isCorrect: false },
      ],
    },
  ];

  const handleAnswerButtonClick = (isCorrect: boolean) => {
    if (isCorrect) {
      setScore(score + 1);
    }

    const nextQuestion = currentQuestion + 1;
    if (nextQuestion < questions.length) {
      setCurrentQuestion(nextQuestion);
    } else {
      setShowScore(true);
    }
  };

  const resetQuiz = () => {
    setCurrentQuestion(0);
    setScore(0);
    setShowScore(false);
  };

  return (
    <div className="flex flex-col items-center justify-center h-screen bg-slate-900 text-white">
      <h1 className="text-4xl font-bold mb-6">Quiz Page</h1>
      
      <div className="bg-slate-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        {showScore ? (
          <div className="text-center">
            <h2 className="text-2xl mb-4">
              You scored {score} out of {questions.length}
            </h2>
            <button
              onClick={resetQuiz}
              className="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition-colors"
            >
              Restart Quiz
            </button>
          </div>
        ) : (
          <div>
            <div className="mb-6">
              <div className="text-sm mb-2">
                Question {currentQuestion + 1}/{questions.length}
              </div>
              <div className="text-xl mb-4">{questions[currentQuestion].questionText}</div>
            </div>
            <div className="space-y-3">
              {questions[currentQuestion].answerOptions.map((answerOption, index) => (
                <button
                  key={index}
                  onClick={() => handleAnswerButtonClick(answerOption.isCorrect)}
                  className="w-full text-left px-4 py-2 bg-slate-700 rounded hover:bg-slate-600 transition-colors"
                >
                  {answerOption.answerText}
                </button>
              ))}
            </div>
          </div>
        )}
      </div>
      
      <div className="mt-6">
        <a 
          href="stores.html" 
          className="text-blue-400 hover:text-blue-300 underline"
        >
          Go to Stores Page
        </a>
      </div>
    </div>
  );
}

export default QuizPage;
