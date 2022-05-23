import React from "react";
import "./App.scss";
import Header from "./components/Header";
import Footer from "./components/Footer";
import Display from "./components/Display";

function App() {

	return (
		<div className="App pt-3">
			<div className="container d-flex flex-column h-100">
				<Header />
				<Display />
				<Footer />
			</div>
		</div>
	);
}

export default App;
