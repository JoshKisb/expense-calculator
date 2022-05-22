import "./Loading.scss";

const Loading: React.FC = () => {
	return (
		<div className="d-flex justify-content-center align-items-center h-100">
			<div className="lds-roller">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	);
};

export default Loading;
