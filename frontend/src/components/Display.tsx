import { useState } from "react";
import { Category } from "../interfaces/Category";
import Form from "./Form";
import Loading from "./Loading";
import ResultTable from "./ResultTable";

const Display: React.FC = () => {
	const [loading, setLoading] = useState(false);
	const [categories, setCategories] = useState<Category[]>([]);
	const [showTable, setShowTable] = useState(false);

	const renderPage = () => {
		if (loading) {
			return <Loading />;
		} else if (showTable) {
			return <ResultTable categories={categories} />;
		} else {
			return <Form />;
		}
	};

	return <div className="content">{renderPage()}</div>;
};

export default Display;
