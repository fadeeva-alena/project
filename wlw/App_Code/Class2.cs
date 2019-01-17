using System;
using System.Data;
using System.Configuration;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Xml;
using System.Web.Services;
using System.Drawing.Design;
using System.ComponentModel;
using System.Text;

namespace SearchDB
{
    /// <summary>
    /// Summary description for Class2
    /// </summary>
    [ToolboxItem(false), WebService(Namespace = "http://tempuri.org/"), WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    public class ServiceSearch : WebService
    {
        // Methods
        [WebMethod]
        public XmlDocument Details(int personID)
        {
            XmlDocument document = new XmlDocument();
            try
            {
                try
                {
                    DataSet ds = UtilData.GetRecordSet("select * from t_people where people_ID=" + personID);
                    if (ds.Tables.Count == 0)
                    {
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("detail");
                        writer.WriteValue("No table returned");
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                    }
                    else if (ds.Tables[0].Rows.Count == 0)
                    {
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("detail");
                        writer.WriteValue("No row returned");
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                    }
                    else
                    {
                        DataRow row = ds.Tables[0].Rows[0];
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("detail");
                        writer.WriteStartElement("email");
                        writer.WriteValue(row["email"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("phone");
                        writer.WriteValue(row["tel_p"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("hourly");
                        writer.WriteValue(row["price_per_hour"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("note");
                        writer.WriteValue(row["note"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("geo-longitude");
                        writer.WriteValue(row["longitude"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("geo-latitude");
                        writer.WriteValue(row["latitude"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("monday");
                        writer.WriteValue(row["monday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("tuesday");
                        writer.WriteValue(row["tuesday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("wednesday");
                        writer.WriteValue(row["wednesday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("thursday");
                        writer.WriteValue(row["thursday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("friday");
                        writer.WriteValue(row["friday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("saturday");
                        writer.WriteValue(row["saturday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("sunday");
                        writer.WriteValue(row["sunday"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("monday_t");
                        writer.WriteValue(row["monday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("tuesday_t");
                        writer.WriteValue(row["tuesday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("wednesday_t");
                        writer.WriteValue(row["wednesday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("thursday_t");
                        writer.WriteValue(row["thursday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("friday_t");
                        writer.WriteValue(row["friday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("saturday_t");
                        writer.WriteValue(row["saturday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("sunday_t");
                        writer.WriteValue(row["sunday_t"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("psych_time_loose_tight");
                        writer.WriteValue(row["psych_time_loose_tight"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("psych_exact_creativ");
                        writer.WriteValue(row["psych_exact_creativ"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("psych_heart_thing");
                        writer.WriteValue(row["psych_heart_thing"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("psych_easy_security");
                        writer.WriteValue(row["psych_easy_security"].ToString());
                        writer.WriteEndElement();
                        writer.WriteStartElement("psych_conflict_take_leave");
                        writer.WriteValue(row["psych_conflict_take_leave"].ToString());
                        writer.WriteEndElement();
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                    }

                }
                catch (Exception)
                {
                }
            }
            finally
            {
            }
            return document;
        }

        private int getPeopleID(string userName, string passWord)
        {
            try
            {
                return int.Parse(UtilData.GetRecordSet("SELECT people_id FROM t_people where username='" + userName + "' and password='" + passWord + "'").Tables[0].Rows[0][0].ToString());
            }
            catch
            {
                return -1;
            }
        }

        private void InitializeComponent()
        {
        }

        [WebMethod]
        public Boolean UserLogin(string userName, string passWord)
        {
            Int32 Output = getPeopleID(userName, passWord);
            if (Output > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        [WebMethod]
        public XmlDocument UserLoginWithDetail(string userName, string passWord)
        {
            Int32 personID = getPeopleID(userName, passWord);
            return Query("select * from t_people where people_ID=" + personID);
            //return Details(Output);
        }

        [WebMethod]
        public XmlDocument CategoriesSubCategoriesGet()
        {
            XmlDocument document = new XmlDocument();
            DataSet recordSet = UtilData.GetRecordSet("SELECT * FROM t_skill_types");
            DataSet recordSet2 = UtilData.GetRecordSet("SELECT * FROM t_skill_subtype");




            StringBuilder output = new StringBuilder();
            XmlWriter writer = XmlWriter.Create(output);
            writer.WriteStartDocument();
            writer.WriteStartElement("AllData");


            writer.WriteStartElement("Categories");
            //Categories Here
            foreach (DataRow row in recordSet.Tables[0].Rows)
            {
                writer.WriteStartElement("item");
                WriteElement(writer, "skilltype_id", row["skilltype_id"].ToString());
                WriteElement(writer, "skilltype", row["skilltype"].ToString());
                WriteElement(writer, "image_path", row["image_path"].ToString());
                writer.WriteEndElement();
            }
            writer.WriteEndElement();


            writer.WriteStartElement("SubCategories");
            //Categories Here
            foreach (DataRow row in recordSet2.Tables[0].Rows)
            {
                writer.WriteStartElement("item");
                WriteElement(writer, "skill_type_id", row["skill_type_id"].ToString());
                WriteElement(writer, "skill_subtype_id", row["skill_subtype_id"].ToString());
                WriteElement(writer, "skill_subtype", row["skill_subtype"].ToString());
                writer.WriteEndElement();
            }
            writer.WriteEndElement();


            writer.WriteEndElement();
            writer.Flush();
            document.LoadXml(output.ToString());

            return document;
        }

        [WebMethod]
        public XmlDocument SearchWB(string userName, string passWord, int searchOrOffer, int cat, int kinds, int gender)
        {
            try
            {
                string sqlString = "";
                int num = this.getPeopleID(userName, passWord);
                if (num == -1)
                {
                    XmlDocument document1 = new XmlDocument();
                    StringBuilder output1 = new StringBuilder();
                    XmlWriter writer1 = XmlWriter.Create(output1);
                    writer1.WriteStartDocument();
                    writer1.WriteStartElement("detail");
                    writer1.WriteValue("No table returned");
                    writer1.WriteEndElement();
                    writer1.Flush();
                    document1.LoadXml(output1.ToString());
                    return document1;
                }
                String GenderString = "";
                if (gender == 0 || gender == 1)
                {
                    GenderString = " and gender = " + (gender + 1).ToString();
                }

                String SubCategoryString = "";
                if (kinds > 0)
                {
                    switch (searchOrOffer)
                    {
                        case 0:
                            SubCategoryString = " And skill_subtype_id ='" + kinds.ToString() + "'";
                            break;
                        case 1:
                            SubCategoryString = " And need_subtype_id ='" + kinds.ToString() + "'";
                            break;
                    }
                }

                switch (searchOrOffer)
                {
                    case 0:
                        sqlString = "SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE skill_type_id ='" + cat.ToString() + "' " + SubCategoryString + " And  t_people.people_id !=" + num.ToString() + GenderString + " and t_people.locationarea = (SELECT locationarea FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1)";
                        #region MyRegion
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE skill_type_id ='" + cat.ToString() + "' And skill_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + GenderString + " and t_people.locationarea = (SELECT locationarea FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1)";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE skill_type_id ='" + cat.ToString() + "' And skill_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + GenderString + " and (zip = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + ") OR zip =(select Zip from _taccess where zip_area = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1) limit 1))";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE skill_type_id ='" + cat.ToString() + "' And skill_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + " and gender=" + gender.ToString() + " and zip = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + ")";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='" + cat.ToString() + "' And skill_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + " and gender=" + gender.ToString(); 
                        #endregion
                        break;

                    case 1:
                        sqlString = "SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE need_type_id ='" + cat.ToString() + "' " + SubCategoryString + " And  t_people.people_id !=" + num.ToString() + GenderString + " and t_people.locationarea = (SELECT locationarea FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1)";
                        #region MyRegion
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE need_type_id ='" + cat.ToString() + "' And need_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + GenderString + " and t_people.locationarea = (SELECT locationarea FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1)";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE need_type_id ='" + cat.ToString() + "' And need_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + GenderString + " and (zip = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + ") OR zip =(select Zip from _taccess where zip_area = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + " limit 1) limit 1))";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE need_type_id ='" + cat.ToString() + "' And need_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + " and gender=" + gender.ToString() + " and zip = (SELECT zip FROM t_people WHERE t_people.people_id = " + num.ToString() + ")";
                        //sqlString = "SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='" + cat.ToString() + "' And need_subtype_id ='" + kinds.ToString() + "' And  t_people.people_id !=" + num.ToString() + " and gender=" + gender.ToString(); 
                        #endregion
                        break;
                }
                DataSet recordSet = UtilData.GetRecordSet(sqlString);
                DataSet ds = UtilData.GetRecordSet("select * from t_people where people_ID=" + num.ToString());
                Double Lat1 = Convert.ToDouble(ds.Tables[0].Rows[0]["latitude"]);
                Double Lon1 = Convert.ToDouble(ds.Tables[0].Rows[0]["longitude"]);
                recordSet.Tables[0].Columns.Add("Distance", typeof(Double));
                foreach (DataRow DtRow in recordSet.Tables[0].Rows)
                {
                    DtRow["Distance"] = distance(Lat1, Lon1, Convert.ToDouble(DtRow["latitude"]), Convert.ToDouble(DtRow["longitude"]));
                }
                DataView DtVw = recordSet.Tables[0].DefaultView;
                DtVw.Sort = "Distance";
                StringBuilder output = new StringBuilder();
                XmlWriter writer = XmlWriter.Create(output);
                writer.WriteStartDocument();
                writer.WriteStartElement("infoList");
                //writer.WriteStartElement("UserId");
                //writer.WriteValue(num.ToString());
                //writer.WriteEndElement();
                //writer.WriteStartElement("Query");
                //writer.WriteValue(sqlString.ToString());
                //writer.WriteEndElement();
                //writer.WriteStartElement("RecordCount");
                //writer.WriteValue(recordSet.Tables[0].Rows.Count.ToString());
                //writer.WriteEndElement();
                foreach (DataRow row in DtVw.ToTable().Rows)
                {
                    writer.WriteStartElement("item");
                    writer.WriteStartElement("people_id");
                    writer.WriteValue(row["people_id"].ToString());
                    writer.WriteEndElement();


                    writer.WriteStartElement("institution");
                    writer.WriteValue(row["institution"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("prof_provider");
                    writer.WriteValue(row["prof_provider"].ToString());
                    writer.WriteEndElement();


                    writer.WriteStartElement("image_path");
                    writer.WriteValue(row["image_path"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("longitude");
                    writer.WriteValue(row["longitude"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("latitude");
                    writer.WriteValue(row["latitude"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("sessionId");
                    writer.WriteValue(row["people_id"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("name");
                    writer.WriteValue(row["firstname"].ToString() + " " + row["lastname"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("address");
                    writer.WriteValue(row["street"].ToString() + " " + row["house_nr"].ToString() + ", " + row["zip"].ToString() + " " + row["location"].ToString());
                    writer.WriteEndElement();
                    writer.WriteStartElement("gender");
                    writer.WriteValue(row["gender"].ToString());
                    writer.WriteEndElement();
                    writer.WriteEndElement();
                }
                writer.WriteEndElement();
                writer.Flush();
                XmlDocument document = new XmlDocument();
                document.LoadXml(output.ToString());
                return document;
            }
            catch (Exception ex)
            {
                XmlDocument document1 = new XmlDocument();
                StringBuilder output1 = new StringBuilder();
                XmlWriter writer1 = XmlWriter.Create(output1);
                writer1.WriteStartDocument();
                writer1.WriteStartElement("detail");
                writer1.WriteValue(ex.Message);
                writer1.WriteEndElement();
                writer1.Flush();
                document1.LoadXml(output1.ToString());
                return document1;
            }
        }

        [WebMethod]
        public XmlDocument CategoryListGet()
        {
            try
            {
                DataSet recordSet = UtilData.GetRecordSet("SELECT * FROM t_skill_types");
                StringBuilder output = new StringBuilder();
                XmlWriter writer = XmlWriter.Create(output);
                writer.WriteStartDocument();
                writer.WriteStartElement("infoList");
                foreach (DataRow row in recordSet.Tables[0].Rows)
                {
                    writer.WriteStartElement("item");
                    WriteElement(writer, "skilltype_id", row["skilltype_id"].ToString());
                    WriteElement(writer, "skilltype", row["skilltype"].ToString());
                    WriteElement(writer, "image_path", row["image_path"].ToString());
                    writer.WriteEndElement();
                }
                writer.WriteEndElement();
                writer.Flush();
                XmlDocument document = new XmlDocument();
                document.LoadXml(output.ToString());
                return document;
            }
            catch (Exception ex)
            {
                XmlDocument document1 = new XmlDocument();
                StringBuilder output1 = new StringBuilder();
                XmlWriter writer1 = XmlWriter.Create(output1);
                writer1.WriteStartDocument();
                writer1.WriteStartElement("detail");
                writer1.WriteValue(ex.Message);
                writer1.WriteEndElement();
                writer1.Flush();
                document1.LoadXml(output1.ToString());
                return document1;
            }
        }

        [WebMethod]
        public XmlDocument SubCategoryListGet(Int32 CategoryId)
        {
            try
            {
                DataSet recordSet = UtilData.GetRecordSet("SELECT * FROM t_skill_types WHERE t_skill_subtype = " + CategoryId.ToString());
                StringBuilder output = new StringBuilder();
                XmlWriter writer = XmlWriter.Create(output);
                writer.WriteStartDocument();
                writer.WriteStartElement("infoList");
                foreach (DataRow row in recordSet.Tables[0].Rows)
                {
                    writer.WriteStartElement("item");
                    WriteElement(writer, "skill_subtype_id", row["skill_subtype_id"].ToString());
                    WriteElement(writer, "skill_subtype", row["skill_subtype"].ToString());
                    writer.WriteEndElement();
                }
                writer.WriteEndElement();
                writer.Flush();
                XmlDocument document = new XmlDocument();
                document.LoadXml(output.ToString());
                return document;
            }
            catch (Exception ex)
            {
                XmlDocument document1 = new XmlDocument();
                StringBuilder output1 = new StringBuilder();
                XmlWriter writer1 = XmlWriter.Create(output1);
                writer1.WriteStartDocument();
                writer1.WriteStartElement("detail");
                writer1.WriteValue(ex.Message);
                writer1.WriteEndElement();
                writer1.Flush();
                document1.LoadXml(output1.ToString());
                return document1;
            }
        }

        void WriteElement(XmlWriter writer, String TagName, String Value)
        {
            writer.WriteStartElement(TagName);
            writer.WriteValue(Value);
            writer.WriteEndElement();
        }

        [WebMethod]
        public XmlDocument Query(String Query)
        {
            XmlDocument document = new XmlDocument();
            try
            {
                try
                {
                    DataSet ds = UtilData.GetRecordSet(Query.Replace("delete", "").Replace("update", ""));
                    if (ds.Tables.Count == 0)
                    {
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("detail");
                        writer.WriteValue("No table returned");
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                    }
                    else if (ds.Tables[0].Rows.Count == 0)
                    {
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("detail");
                        writer.WriteValue("No row returned");
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                    }
                    else
                    {
                        StringBuilder output = new StringBuilder();
                        XmlWriter writer = XmlWriter.Create(output);
                        writer.WriteStartDocument();
                        writer.WriteStartElement("infoList");
                        //writer.WriteStartElement("UserId");
                        //writer.WriteValue(num.ToString());
                        //writer.WriteEndElement();
                        //writer.WriteStartElement("Query");
                        //writer.WriteValue(sqlString.ToString());
                        //writer.WriteEndElement();
                        //writer.WriteStartElement("RecordCount");
                        //writer.WriteValue(recordSet.Tables[0].Rows.Count.ToString());
                        //writer.WriteEndElement();
                        foreach (DataRow row in ds.Tables[0].Rows)
                        {
                            writer.WriteStartElement("item");
                            foreach (DataColumn DtCol in ds.Tables[0].Columns)
                            {
                                writer.WriteStartElement(DtCol.ColumnName);
                                writer.WriteValue(row[DtCol.Ordinal].ToString());
                                writer.WriteEndElement();
                            }
                            writer.WriteEndElement();
                        }
                        writer.WriteEndElement();
                        writer.Flush();
                        document.LoadXml(output.ToString());
                        return document;
                    }

                }
                catch (Exception)
                {
                }
            }
            finally
            {
            }
            return document;
        }

        private double distance(double lat1, double lon1, double lat2, double lon2)
        {
            double theta = lon1 - lon2;
            double dist = Math.Sin(deg2rad(lat1)) * Math.Sin(deg2rad(lat2)) + Math.Cos(deg2rad(lat1)) * Math.Cos(deg2rad(lat2)) * Math.Cos(deg2rad(theta));
            dist = Math.Acos(dist);
            dist = rad2deg(dist);
            dist = dist * 60 * 1.1515;

            return (dist);
        }

        private double rad2deg(double rad)
        {
            return (rad / Math.PI * 180.0);
        }

        private double deg2rad(double deg)
        {
            return (deg * Math.PI / 180.0);
        }
    }
}