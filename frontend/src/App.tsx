import { useState } from "react";
import logo from "./logo.svg";
import "./App.scss";
import Header from "./components/Header";
import Footer from "./components/Footer";
import Display from "./components/Display";

function App() {
	const [count, setCount] = useState(0);

	return (
		<div className="App bg-light pt-3">
			<div className="container d-flex flex-column h-100">
				<Header />
				<Display />
				<Footer />
			</div>
		</div>
	);
}

export default App;
