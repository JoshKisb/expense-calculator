import axios from "axios";
import { useState } from "react";
import { Category } from "../interfaces/Category";
import Form from "./Form";
import Loading from "./Loading";
import ResultTable from "./ResultTable";

const Display: React.FC = () => {
	const [loading, setLoading] = useState(false);
	const [categories, setCategories] = useState<Category[]>([]);
	const [showTable, setShowTable] = useState(false);

	const uploadCSV = (formData: FormData) => {
		const apiUrl = import.meta.env.VITE_API_URL;
		const url = `${apiUrl}/upload.php`;

      setLoading(true);
		axios
			.post(url, formData)
			.then((res) => {
            console.log(res.data);
            setCategories(res.data);
            setShowTable(true);
			})
			.finally(() => {
				setLoading(false);
			});
	};

	const renderPage = () => {
		if (loading) {
			return <Loading />;
		} else if (showTable) {
			return <ResultTable categories={categories} />;
		} else {
			return <Form onSubmit={uploadCSV} />;
		}
	};

	return <div className="content">{renderPage()}</div>;
};

export default Display;
