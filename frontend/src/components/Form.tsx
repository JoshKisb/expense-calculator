const Form: React.FC = () => {
	return (
		<form className="form">
			<div>
				<label htmlFor="formFileLg" className="form-label">
					Large file input example
				</label>
				<input
					className="form-control form-control-lg"
					id="formFileLg"
					type="file"
				/>
			</div>
		</form>
	);
};

export default Form;
